<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
/** Paypal Details classes **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\Auth;

use App\userOrder;
use App\orderPackage;
use Config;
use App\setting;
use App\promotion;
use PaypalMassPayment;
class PaymentController extends Controller
{
    private $api_context;
/** 
    ** We declare the Api context as above and initialize it in the contructor
    **/
    public function __construct()
    {

        //echo config('paypal.client_id').'--'.config('paypal.secret');die;
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $this->api_context->setConfig(config('paypal.settings'));
         //echo "<pre>";print_r($this->api_context);die;
    }
    public function paypal_payout()
    {
        $token='EOjEJigcsRhdOgD7_76lPfrr45UfuI43zzNzTktUk1MK';
       if ($token) {
            $ch = curl_init();

            $data = [
                    'sender_batch_header' => [
                        'email_subject' => "You have a payment",
                        'sender_batch_id' => '184328423'

                    ],
                    'items' => [
                        [
                            'recipient_type' => "EMAIL",
                            'amount' => [
                                'value' => "12.00",
                                'currency' => "USD"
                            ],
                            'receiver' => 'neargym@gmail.com',
                            'note' => 'Hello World',
                            'sender_item_id' => "A123"
                        ],
                    ],
                ];


            $headers = [
                'Content-Type:application/json',
                'Authorization:Bearer ' . $token,
            ];



            curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payouts?sync_mode=true");
            // curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $result = curl_exec($ch);

            if(empty($result))die("Error: No response.");
            else
            {
                $json = json_decode($result);
                print_r($json);
            }

            curl_close($ch);

        }
    }
    public function sendPaymentToseller()
    {
            $payouts = new \PayPal\Api\Payout();
            $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");
            $senderItem = new \PayPal\Api\PayoutItem();
            $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver('neargym@gmail.com')
            ->setSenderItemId("00111")
            ->setAmount(new \PayPal\Api\Currency('{
                                    "value":"1.00",
                                    "currency":"USD"
                                }'));
            $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);

            $request = clone $payouts;

            try {
              //  $output = $payouts->createSynchronous(array('sync_mode',false),$this->api_context);
                $output = $payouts->create(array('sync_mode',false), $this->api_context);

                echo "<pre>";print_r($output);die;
            } catch (\Exception $ex) {
                
                //\ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
                echo "<pre>";dd($ex);die;
                exit(1);
            }
            // \ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);

            echo "<pre>";print_r($output);die;
            return $output;
    }
    /**
    ** This method sets up the paypal payment.
    **/
    public function createPayment(Request $request)
    {
        // Amount received as request is validated here.
        $request->validate(['amount' => 'required|numeric']);
        $pay_amount = $request->amount;
        // We create the payer and set payment method, could be any of "credit_card", "bank", "paypal", "pay_upon_invoice", "carrier", "alternate_payment". 
        //$settings=setting::find(1);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Create and setup items being paid for.. Could multiple items like: 'item1, item2 etc'.
        $carts = session()->get('cart');
       $settings=setting::find(1);
       //echo "<pre>";print_r($carts);die;
        $items=array();
        $item='';
        $subTotal=0;
        $gym_id='';
        $maintenace_charges=$settings->maintenance_charges;
        $tax_percentage=$settings->tax_percentage;
        $services_charges=$settings->services_charges;
        //echo config('constants.tax_percentage').'//'.$maintenace_charges;die;
        if($carts && Auth::check())
        {
            $user_id=Auth::user()->id;
            $userOrder= new userOrder;
            $userOrder->user_id=$user_id;
            $userOrder->save();
            $total_seller_amount=0;
            $total_admin_comission=0;
            //echo $userOrder->id;
            foreach ($carts as $key => $cart) 
            {
                $price=$this->price_format($cart['quantity'] * $cart['price']);
                $seller_amount=$this->price_format($cart['quantity'] * $cart['seller_amount']);
                $admin_comission=$this->price_format($cart['quantity'] * $cart['admin_comission']);
                $item = new Item();
                $item->setName($cart['name'])
                ->setCurrency('INR')
                ->setQuantity('1')
                ->setPrice($price);
                $items[]=$item;
                $subTotal +=$price;
                $total_seller_amount +=$seller_amount;
                $total_admin_comission +=$admin_comission;

                $gym_id=$cart['gym_id'];
               $orderPackage=new orderPackage;
               $orderPackage->user_order_id=$userOrder->id;
               $orderPackage->gym_package_id=$cart['pack_id'];
               $orderPackage->start_from=$cart['starting_from'];
               $orderPackage->booking_for=$cart['booking_for'];
               $orderPackage->amount=$this->price_format($cart['seller_amount']);
               $orderPackage->quantity=$cart['quantity'];
               $orderPackage->gym_membership_id=$cart['gym_membership_id'];
               $orderPackage->sub_total=$this->price_format($seller_amount);
               $orderPackage->user_amount=$this->price_format($price);
                $orderPackage->save();
            }
        }
        else
        {
             $message="Something went wrong !!! Please try again";
            return redirect()->route('welcome')
                        ->with('error',$message);
        }

        // /********* Add maintenance charges********************/
        // $item_maintenace = new Item();
        // $item_maintenace->setName('Maintenance Charges')
        //     ->setCurrency('INR')
        //     ->setQuantity(1)
        //     ->setPrice($maintenace_charges);
        // $items[]=$item_maintenace;
        // $item_service_charge = new Item();
        // $item_service_charge->setName('Service Charges')
        //     ->setCurrency('INR')
        //     ->setQuantity(1)
        //     ->setPrice($services_charges);
        // $items[]=$item_service_charge;


        $order_id=$userOrder->id;
        $userOrder = userOrder::find($order_id);

        //$tax=($subTotal * $tax_percentage/100);
        $totalAmount=$this->price_format($subTotal);
      
       
        $userOrder->subtotal=$totalAmount;
        $userOrder->seller_amount=$this->price_format($total_seller_amount);
        $userOrder->net_payment=$totalAmount;
        $userOrder->gym_id=$gym_id;
        $userOrder->maintence_charges=$this->price_format($total_seller_amount*$maintenace_charges/100);
        $userOrder->service_charges=$this->price_format($total_seller_amount*$services_charges/100);
        $userOrder->tax=$this->price_format($total_seller_amount*$tax_percentage/100);
        $userOrder->admin_comission=$this->price_format($total_admin_comission);
        $userOrder->save();

        // echo "<pre>";print_r($items);die;
        //echo $totalAmount;die;
        //echo $totalAmount.'/'.$tax.'/'."<pre>";print_r($items);die;
        // Create item list and set array of items for the item list.
        $itemList = new ItemList();
        $itemList->setItems($items);
        // Create and setup the total amount.
         //$subTotal +=$maintenace_charges+$services_charges;
        //  $details = new Details();
        //  $details->setTax($tax)
        // ->setSubtotal($subTotal);

        $amount = new Amount();
        $amount->setCurrency('INR')
        ->setTotal($totalAmount);
       // ->setDetails($details);
         $description= 'Pay to Near Gym';
        // Create a transaction and amount and description.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription($description);
        //You can set custom data with '->setCustom($data)' or put it in a session.
        // Create a redirect urls, cancel url brings us back to current page, return url takes us to confirm payment.
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('confirm-payment'))
        ->setCancelUrl(route('confirm-payment'));
        // We set up the payment with the payer, urls and transactions.
        // Note: you can have different itemLists, then different transactions for it.
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
        // Put the payment creation in try and catch in case of exceptions.
        try {
            $payment->create($this->api_context);
        } catch (PayPalConnectionException $ex){
            //echo "<pre>";dd($ex);die;
            return back()->withError('Some error occur, sorry for inconvenient');
        } catch (Exception $ex) {
            return back()->withError('Some error occur, sorry for inconvenient');
        }
        // We get 'approval_url' a paypal url to go to for payments.
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // You can set a custom data in a session
         $request->session()->put('order_id', $order_id);
        // We redirect to paypal tp make payment
        if(isset($redirect_url)) {
            return redirect($redirect_url);
        }
        // If we don't have redirect url, we have unknown error.
        return redirect()->back()->withError('Unknown error occurred');
    }
    public function price_format($number)
    {
        return number_format((float)$number, 2, '.', '');
    }
    /*
     *This method confirms if payment with paypal was processed successful and then execute payment, 
     * we have 'paymentId, PayerID and token' in query string.
     */
    public function confirmPayment(Request $request)
    {
        // If query data not available... no payments was made.
       // echo "<pre>";print_r($request->all());die;
        $order_id = session()->get('order_id');
        if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token')))
        {
            $userOrder = userOrder::find($order_id);
            $userOrder->status='2';
            $userOrder->save();
            return redirect('/profile/order/'.$order_id)->withError('Payment was not successful. Please Try Again !!');
        }
            
        // We retrieve the payment from the paymentId.
        $payment = Payment::get($request->query('paymentId'), $this->api_context);
        // We create a payment execution with the PayerId
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));
        // Then we execute the payment.
        $result = $payment->execute($execution, $this->api_context);
        // Get value store in array and verified data integrity
        // $value = $request->session()->pull('key', 'default');
        // Check if payment is approved
        if ($result->getState() == 'approved')
        {
            
            if(isset($order_id))
            {
                $userOrder = userOrder::find($order_id);
                $userOrder->payment_id=$request->query('paymentId');
                $userOrder->payer_id=$request->query('PayerID');
                $userOrder->status='1';
                $userOrder->save();

            }
            //$cart = session()->get('cart');
            $request->session()->forget('cart');
            return redirect('/profile/order/'.$order_id)->withSuccess('Payment made successfully.');
        }
        else
        {
            return redirect('/profile/order/'.$order_id)->withError('Payment was not successful.'); 
        }
       
    }


    public function payWithpaypal(Request $request)
    {
          $request->validate(['amount' => 'required|numeric']);
            // $pay_amount = $request->amount;
            $payer = new Payer();
                    $payer->setPaymentMethod('paypal');
            $item_1 = new Item();
            $item_1->setName('Item 1') /** item name **/
                        ->setCurrency('USD')
                        ->setQuantity(1)
                        ->setPrice($request->get('amount')); /** unit price **/
            $item_list = new ItemList();
                    $item_list->setItems(array($item_1));
            $amount = new Amount();
                    $amount->setCurrency('USD')
                        ->setTotal($request->get('amount'));
            $transaction = new Transaction();
                    $transaction->setAmount($amount)
                        ->setItemList($item_list)
                        ->setDescription('Your transaction description');
            $redirect_urls = new RedirectUrls();
                    $redirect_urls->setReturnUrl(route('confirm-payment')) /** Specify return URL **/
                        ->setCancelUrl(route('confirm-payment'));
            $payment = new Payment();
                    $payment->setIntent('Sale')
                        ->setPayer($payer)
                        ->setRedirectUrls($redirect_urls)
                        ->setTransactions(array($transaction));
                    /** dd($payment->create($this->_api_context));exit; **/
                    try {
            $payment->create($this->api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
            \Session::put('error', 'Connection timeout');
                            return Redirect::route('paywithpaypal');
            } else {
            \Session::put('error', 'Some error occur, sorry for inconvenient');
                            return Redirect::route('paywithpaypal');
            }
            }
            foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
                            break;
            }
            }
            /** add payment ID to session **/
                   // Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
            /** redirect to paypal **/
                      return redirect($redirect_url);
            }
            \Session::put('error', 'Unknown error occurred');
                    return Redirect::route('paywithpaypal');
    }


}
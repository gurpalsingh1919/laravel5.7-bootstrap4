<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import the class namespaces first, before using it directly
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Facades\PayPal;
class PaypalController extends Controller
{
    private $api_context;
    /** 
    ** We declare the Api context as above and initialize it in the contructor
    **/
    public function __construct()
    {

         $this->provider = new AdaptivePayments;
        $this->provider  = PayPal::setProvider('adaptive_payments'); 
        $config=config('paypal');
        $this->provider->setApiCredentials($config);
    }
    /**
    ** This method sets up the paypal payment.
    **/
    public function createPayment(Request $request)
    {
    	// Change the values accordingly for your application
			$data = [
			    'receivers'  => [
			        [
			            'email' => 'johndoe@example.com',
			            'amount' => 10,
			            'primary' => true,
			        ],
			        [
			            'email' => 'janedoe@example.com',
			            'amount' => 5,
			            'primary' => false
			        ]
			    ],
			    'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
			    'return_url' => route('confirm-payment'), 
			    'cancel_url' => route('confirm-payment'),
			];

			$response = $this->provider->createPayRequest($data);
			echo "<pre>";print_r($response);die;
			$redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);

			return redirect($redirect_url);
    }
}

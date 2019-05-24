<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Seller;
use App\productCategory;
use App\storeCategory;
use Illuminate\Support\Facades\Auth;

use App\gymLocation;
use App\gymPackage;
use App\gymPackageType;
use App\gymCity;
use App\gymCategory;
use App\assignNutrition;
use App\assignWorkout;
use DB;
use Hash;
use App\userOrder;
use App\orderPackage;
use App\setting;
use App\promotion;
use Illuminate\Support\Facades\View;
use PackagetoPrice;
use Carbon\Carbon;
class UserController extends Controller
{
protected $settings;
public function __construct()
{
  $settings=setting::find(1);
  // View::share(['settings'=>$settings]);
}
public function getprice()
{
    return 10;
}
public function welcome(Request $request)
{
    //$request->session()->flush();
    $cities=gymCity::all();
    return view('users.home',compact('cities'));
}
public function signin()
{
   return view('users.login'); 
}
public function signup()
{
   return view('users.signup'); 
}
public function forgotPassword()
{
   return view('users.forgot-password');
}
public function resetPassword()
{
    if (Auth::check())
    {
        return view('users.reset-password');
    }
     return redirect()->route('welcome');

}
public function usersignupost(Request $request)
{
     $this->validate($request, [
        'name' => 'required',
        'phone_no'=>'required|regex:/[0-9]{10}/',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password|min:6',
        // 'roles' => 'required'
    ]);


    $input = $request->all();
    $input['password'] = Hash::make($input['password']);
    $input['status'] ='1';
    $input['roles'] ='9';
    

    $user = User::create($input);
    $user->assignRole('9');
    Auth::login($user);
   $cart = session()->get('cart');
    if($cart)
    {
        return redirect()->intended('/check-out');
    }
    


    return redirect()->route('welcome')
                    ->with('success','Congratulation !!! You are registered successfully.');
}
public function sellerLoginPost(Request $request)
{
    $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required',

        
      ]);
    $panel=$request->panel;
    $email=$request->email;
    $password=$request->password;
    //echo "<pre>";print_r($request->all());die;
    $credentials = ['email' => $email, 'password' => $password, 
    'status' => '1'];
    if (Auth::attempt($credentials)) 
    {
        // Authentication passed...
        //echo "success";die;
        $role=Auth::user()->getRoleNames();
        if($role[0]=='user' && $panel=='1')
        {
          $cart = session()->get('cart');
          if($cart)
          {
              return redirect()->intended('/check-out');
          }
          return redirect()->intended('/');
        }
        else if($role[0]=='seller' && $panel=='2')
        {
          return redirect()->intended('/seller/dashboard');
        }
        else if($role[0]=='freelancer' && $panel=='3')
        {
             return redirect()->intended('/trainer/dashboard');
        }
        else if($role[0]=='admin' && $panel=='4')
        {
            return redirect()->intended('/admin/dashboard');
        }
        else if($role[0]=='salesexecutive' && $panel=='5')
        {
            return redirect()->intended('/sales-executive/dashboard');
        }
        else
        {
          auth()->logout();
          $message='Invalid login credentials';
        }
        
    }
    else
    {
      $message='Invalid login credentials';
      
    }
   //echo $message;die;
    return redirect()->back()->with(['error' => $message]);
    
}

public function logout (Request $request) 
{
    //logout user
    //echo Auth::user()->isAdministrator();die;
    if(Auth::user()->isAdministrator())
    {
        $redirect='/administrator';
    }
    else if(Auth::user()->isSeller())
    {
        $redirect='/sellerlogin';
    }
    else if(Auth::user()->isFreelancer())
    {
        $redirect='/trainerlogin';
    }
    else if(Auth::user()->isSalesExecutive())
    {
        $redirect='/sales-executive/login';
    }
    else
    {
        $redirect='/';

    }

    auth()->logout();
    // redirect to homepage
    return redirect($redirect);
}

public function gymsNearYou($city,$cat_id)
{

    //echo $city;die;
   // echo "<pre>";print_r($_COOKIE);die;
    $filter=['city'=>$city,'status'=>'1','seller_type'=>'1'];
    $title='Popular Gyms';
    if(isset($city))
    {
        $gymCategory=gymCategory::all();
        $gymCategories=Seller::Where($filter)
        // ->selectRaw('count(category_id) as gym_sum , category_id')
        // ->groupBy('category_id')
        // ->with('categories')
        ->get();
        $category_data=array();
        foreach ($gymCategories as $key => $value) 
        {
            $sellercategories=$value->category_id;
            $cat_arr=explode("|", $sellercategories);
            for($i=0;$i<count($cat_arr);$i++)
            {
                $category_data[]=$cat_arr[$i];
                //$category_data[] +=1;
            }
        }
        $vals = array_count_values($category_data);
        $new_category_sum=array();
        foreach ($gymCategory as $key => $value) 
        {
            if(isset($vals[$value->id]))
            {
                $new_category_sum[$value->id]=['gym_sum'=>$vals[$value->id],'gym_name'=>$value->name];

            }
            
        }
        //echo "<pre>";print_r($new_category_sum);die;
        $total=Seller::Where($filter)->count();
        if($total=='0')
        {
            $message="Sorry!!! Gym Not Found Around This City.Comming Soon .....";
            return redirect()->route('welcome')
                    ->with('error',$message);
        }

        
    }
    else
    {
        $message="We are not serving this city right now.Comming soon";
        return redirect()->route('welcome')
                    ->with('error',$message);
        
    }
   
    if(isset($cat_id) && $cat_id !=0)
    {
       // $filter['category_id']=$cat_id;
        $cat=gymCategory::where('id',$cat_id)->get();
        $title=$cat[0]->name;
    }
    else
    {
        $cat_id=0;
    }

    $yourlocationgyms=Seller::Where($filter)
    ->with('locations','user','packages')
    //->orderBy('category_id')
    ->get();
    //echo "<pre>";print_r($yourlocationgyms->toArray());die;
    $promotions=promotion::all();
    // $gymCategories=gymCategory::all();
    //echo "<pre>";print_r($promotions->toArray());die;
    // $yourlocationgyms=$yourlocationgyms->toArray();
    //echo $city.'/'.$cat_id;die;
    return view('users.located-gym',compact('yourlocationgyms','new_category_sum','cat_id','title','total','city','promotions'));
}
public function trainersNearYou($city,$cat_id)
{
    $filter=['city'=>$city,'status'=>'1','seller_type'=>'2'];
    $title='Popular Trainer';
    if(isset($city))
    {
        $gymCategory=gymCategory::all();
        $gymCategories=Seller::Where($filter)
        ->get();
        $category_data=array();
        foreach ($gymCategories as $key => $value) 
        {
            $sellercategories=$value->category_id;
            $cat_arr=explode("|", $sellercategories);
            for($i=0;$i<count($cat_arr);$i++)
            {
                $category_data[]=$cat_arr[$i];
            }
        }
        $vals = array_count_values($category_data);
        $new_category_sum=array();
        foreach ($gymCategory as $key => $value) 
        {
            if(isset($vals[$value->id]))
            {
                $new_category_sum[$value->id]=['gym_sum'=>$vals[$value->id],'gym_name'=>$value->name];

            }
            
        }
        $total=Seller::Where($filter)->count();
        if($total=='0')
        {
            $message="Sorry!!! Trainer not found around your location. Comming Soon .....";
            return redirect()->route('welcome')
                    ->with('error',$message);
        }

        
    }
    else
    {
        $message="We are not serving this city right now.We are comming soon";
        return redirect()->route('welcome')
                    ->with('error',$message);
        
    }
   
    if(isset($cat_id) && $cat_id !=0)
    {
       // $filter['category_id']=$cat_id;
        $cat=gymCategory::where('id',$cat_id)->get();
        $title=$cat[0]->name;
    }
    else
    {
        $cat_id=0;
    }

    $yourlocationgyms=Seller::Where($filter)
    ->with('locations','user')
    ->with(['packages' => function ($query) {
          $query->where('status', '=', '1');
      }])
    ->get();
    //echo "<pre>";print_r($yourlocationgyms->toArray());die;
    $promotions=promotion::all();
    return view('users.located-trainer',compact('yourlocationgyms','new_category_sum','cat_id','title','total','city','promotions'));
}
public function gymsDetail($gym_id,Request $request)
{
    $filter=['id'=>$gym_id,'status'=>'1'];
    $title='All';
    $cat_id=0;
    if(isset($gym_id))
    {
        $catfilter=['seller_id'=>$gym_id,'status'=>'1'];
        $total_pack=gymPackage::Where($catfilter)->count();
        if($total_pack=='0')
        {
          $message="Sorry!!! Packages Not added in this Gym station. Will added soon .....";
          return redirect()->back()->with('error', $message);
        }
    }
    else
    {
        $message="Sorry !!! Gym Not Found.";
        return redirect()->route('welcome')->with('error',$message);
    }
   
    $cat_id=$request->cat_id;
    
    $gymdetail= Seller::Where($filter)
    ->with('user')
    ->with(['packages' => function ($query) use($gym_id) {
          $query->where(['seller_id'=>$gym_id,'status'=>'1']);
      },'packages.packageMemberships' => function ($query) {
          $query->where('status', '=', '1');
      }])
    ->first();
   return view('users.trainer-detail',compact('gymdetail','total_pack','cat_id','gym_id'));
}
public function gymPackageDetail($pack_id)
{
    $packagedetail=gymPackage::where(['id'=>$pack_id,'status'=>'1'])
    ->with('gymDetail')
    ->with(['packageMemberships' => function ($query) use ($pack_id) {
          $query->where(['status'=> '1','package_id'=>$pack_id]);
      }])
    ->first();

    if(isset($packagedetail->seller_id) && $packagedetail->seller_id !='')
    {
      $gym_id= $packagedetail->seller_id;
      $catfilter=['seller_id'=>$gym_id,'status'=>'1'];
      $total_pack=gymPackage::Where($catfilter)->count();
      if($total_pack=='0')
      {
          $message="Sorry!!! Packages Not added in this Gym station. Will added soon .....";
         return redirect()->back()->with('error', $message);
      }
    }
    else
    {
      $message="Sorry !!! Gym or Trainer Not Found.";
      return redirect()->route('welcome')->with('error',$message);
        
    }
   
   return view('users.package-detail',compact('packagedetail','total_pack','pack_id'));
}
public function mygymcheckout()
{
  $cart = session()->get('cart');
  if($cart) 
  {
     foreach($cart as $id=>$val)
     {
        $gym_id=$val['gym_id'];
     }
     $gym_detail=Seller::where('id',$gym_id)->get();
     //echo "<pre>";print_r($gym_detail->toArray());die;
     return view('users.checkout',compact('gym_detail'));
  }
  else
  {
     $message="Cart is empty.";
     return redirect()->route('welcome')
                    ->with('error',$message);
  }
    
}
public function addToCart(Request $request,$pack_id)
{
    $packagedetail=gymPackage::Where(['id'=>$pack_id])->with('gymDetail.user')->get();
    //echo "<pre>";print_r(session()->get('settings'));die;
    if(!$packagedetail) {

        abort(404);

    }
    $images= $packagedetail[0]->gymDetail->gym_images;
     $images=explode('|', $images);
    $cart = session()->get('cart');
    
     
    $price=PackagetoPrice::get_package_price($packagedetail[0]->price,$packagedetail[0]->admin_comission);  
    $admin_comission= ($packagedetail[0]->price* $packagedetail[0]->admin_comission/100);   
    // if cart is empty then this the first product
    if(!$cart) {

        $cart = [

           
                $pack_id => [
                    "name" => $packagedetail[0]->title,
                    "quantity" => 1,
                    "price" => $price,
                    "seller_amount" => $packagedetail[0]->price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail[0]->image,
                    "pack_id" => $packagedetail[0]->id,
                    "gym_id" => $packagedetail[0]->seller_id,
                    "gym_image" => $images[0],
                    "gym_address"=>$packagedetail[0]->gymDetail->gym_address.', '.$packagedetail[0]->zip.', '.$packagedetail[0]->city,
                    "gym_name"=> $packagedetail[0]->gymDetail->gym_name,
                    "user_image"=> $packagedetail[0]->gymDetail->user->image,
                    'seller_type'=>$packagedetail[0]->gymDetail->seller_type
                ]
            ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Package added to cart successfully!');
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$pack_id])) {

        $cart[$pack_id]['quantity']++;

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }

    /*
    * if item not exist in cart then add to cart with quantity = 1
    * If package from same gym then add otherwise send message 
    * You can't add add package from different gyms
    */
    $flag=0;
    if(isset($cart))
    {
        foreach($cart as $id=>$val)
        {
            if($packagedetail[0]->seller_id !=$val['gym_id'])
            {
                $flag=1;
               // $message="First Clean Your Previous Cart Then Proceed Another Gym";
                 //return redirect()->back()->with('error', $message);
                unset($cart);
                 $request->session()->flush();


                $cart = [

                $pack_id => [
                    "name" => $packagedetail[0]->title,
                    "quantity" => 1,
                    "price" => $price,
                    "seller_amount" => $packagedetail[0]->price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail[0]->image,
                    "pack_id" => $packagedetail[0]->id,
                    "gym_id" => $packagedetail[0]->seller_id,
                    "gym_image" => $images[0],
                    "gym_address"=>$packagedetail[0]->gymDetail->gym_address.', '.$packagedetail[0]->zip.', '.$packagedetail[0]->city,
                    "gym_name"=> $packagedetail[0]->gymDetail->gym_name,
                    "user_image"=> $packagedetail[0]->gymDetail->user->image,
                    'seller_type'=>$packagedetail[0]->gymDetail->seller_type
                ]
            ];

            session()->put('cart', $cart);
             //session()->put('settings', $settings->toArray());

            }
        }
    }
    if($flag==0)
    {
     
          $cart[$pack_id] = [
                    "name" => $packagedetail[0]->title,
                    "quantity" => 1,
                     "price" => $price,
                    "seller_amount" => $packagedetail[0]->price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail[0]->image,
                    "pack_id" => $packagedetail[0]->id,
                    "gym_id" => $packagedetail[0]->seller_id,
                    "gym_image" => $images[0],
                    "gym_address"=>$packagedetail[0]->gymDetail->gym_address.', '.$packagedetail[0]->zip.', '.$packagedetail[0]->city,
                    "gym_name"=> $packagedetail[0]->gymDetail->gym_name,
                    "user_image"=> $packagedetail[0]->gymDetail->user->image,
                    'seller_type'=>$packagedetail[0]->gymDetail->seller_type
                    ];

            session()->put('cart', $cart);
    }
    
  
    
    return redirect()->back()->with('success', 'PAckage added to cart successfully!');
}
public function newAddToCart(Request $request)
{
  $this->validate($request,[
    'membership'=>'required',
    'start_date'=>'required',
    'booking_for'=>'required',
    'package_id'=>'required'
   ]);
  $pack_id=$request->package_id;
  $packagedetail=gymPackage::where(['status'=>'1','id'=>$pack_id])
    ->with('gymDetail')
    ->with(['packageMemberships' => function ($query) use ($request) {
      $query->where('id', '=', $request->membership);
    }])
    ->first();
    //echo "<pre>";print_r($request->all());die;
    //echo "<pre>";print_r($packagedetail->toArray());die;
    if(!$packagedetail) {
        abort(404);
    }
    $cart = session()->get('cart');
    $main_price=$packagedetail->packageMemberships[0]->price;
    $time=$packagedetail->packageMemberships[0]->duration;
    $duration=PackagetoPrice::get_duration_fullname($time);
    $gym_membership_id=$packagedetail->packageMemberships[0]->id;
    $price=PackagetoPrice::get_package_price($main_price,$packagedetail->admin_comission);
    // echo   $price.'--'.$main_price.'--'.$packagedetail->admin_comission;die;
    $admin_comission= ($main_price* $packagedetail->admin_comission/100); 
    $yrdata= strtotime($request->start_date);  
    // if cart is empty then this the first product
    if(!$cart) {
      $cart = [
        $pack_id => [
                    "name" => $packagedetail->title,
                    "quantity" => 1,
                    "price" => $price,
                    "seller_amount" => $main_price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail->image,
                    "pack_id" => $pack_id,
                    "gym_id" => $packagedetail->seller_id,
                    "gym_image" => $packagedetail->gymDetail->gym_images,
                    "gym_address"=>$packagedetail->gymDetail->gym_address.', '.$packagedetail->zip.', '.$packagedetail->city,
                    "gym_name"=> $packagedetail->gymDetail->gym_name,
                    "user_image"=> $packagedetail->gymDetail->user->image,
                    'seller_type'=>$packagedetail->gymDetail->seller_type,
                    'membership'=>$duration,
                    'membership_id'=>$time,
                    'gym_membership_id'=>$gym_membership_id,
                    'start_from'=>date("F jS, Y",$yrdata),
                    'starting_from'=>$request->start_date,
                    'booking_for'=>$request->booking_for,

                ]
            ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Package membership added to cart successfully!');
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$pack_id])) {

        $cart[$pack_id]['quantity']++;

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Package membership added to cart successfully!');

    }

    /*
    * if item not exist in cart then add to cart with quantity = 1
    * If package from same gym then add otherwise send message 
    * You can't add add package from different gyms
    */
    $flag=0;
    if(isset($cart))
    {
        foreach($cart as $id=>$val)
        {
            if($packagedetail->seller_id !=$val['gym_id'])
            {
                $flag=1;
               // $message="First Clean Your Previous Cart Then Proceed Another Gym";
                 //return redirect()->back()->with('error', $message);
                unset($cart);
                 $request->session()->flush();


                $cart = [

                 $pack_id => [
                    "name" => $packagedetail->title,
                    "quantity" => 1,
                    "price" => $price,
                    "seller_amount" => $main_price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail->image,
                    "pack_id" => $pack_id,
                    "gym_id" => $packagedetail->seller_id,
                    "gym_image" => $packagedetail->gymDetail->gym_images,
                    "gym_address"=>$packagedetail->gymDetail->gym_address.', '.$packagedetail->zip.', '.$packagedetail->city,
                    "gym_name"=> $packagedetail->gymDetail->gym_name,
                    "user_image"=> $packagedetail->gymDetail->user->image,
                    'seller_type'=>$packagedetail->gymDetail->seller_type,
                    'membership'=>$duration,
                    'membership_id'=>$time,
                    'gym_membership_id'=>$gym_membership_id,
                    'start_from'=>date("F jS, Y",$yrdata),
                    'starting_from'=>$request->start_date,
                    'booking_for'=>$request->booking_for,
                ]
            ];

            session()->put('cart', $cart);
             //session()->put('settings', $settings->toArray());

            }
        }
    }
    if($flag==0)
    {
     
          $cart[$pack_id] = [
                   "name" => $packagedetail->title,
                    "quantity" => 1,
                    "price" => $price,
                    "seller_amount" => $main_price,
                    "admin_comission"=>$admin_comission,
                    "photo" => $packagedetail->image,
                    "pack_id" => $pack_id,
                    "gym_id" => $packagedetail->seller_id,
                    "gym_image" => $packagedetail->gymDetail->gym_images,
                    "gym_address"=>$packagedetail->gymDetail->gym_address.', '.$packagedetail->zip.', '.$packagedetail->city,
                    "gym_name"=> $packagedetail->gymDetail->gym_name,
                    "user_image"=> $packagedetail->gymDetail->user->image,
                    'seller_type'=>$packagedetail->gymDetail->seller_type,
                    'membership'=>$duration,
                    'membership_id'=>$time,
                    'gym_membership_id'=>$gym_membership_id,
                    'start_from'=>date("F jS, Y",$yrdata),
                    'starting_from'=>$request->start_date,
                    'booking_for'=>$request->booking_for,
                    ];

            session()->put('cart', $cart);
    }
    
  
    
    return redirect()->back()->with('success', 'Package membership added to cart successfully!');
}

public function remove(Request $request)
{
    if($request->id) {

        $cart = session()->get('cart');

        if(isset($cart[$request->id])) {

            unset($cart[$request->id]);

            session()->put('cart', $cart);
        }

        session()->flash('success', 'Product removed successfully');
    }
}
public function removeAll(Request $request)
{
    $cart = session()->get('cart');
    unset($cart);
    $request->session()->flush();
    session()->flash('success', 'All items removed from cart successfully');
}
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index(Request $request)
{
    $data = User::orderBy('id','DESC')->paginate(5);
    return view('users.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
}


/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $roles = Role::pluck('name','name')->all();
    return view('users.create',compact('roles'));
}


/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required'
    ]);


    $input = $request->all();
    $input['password'] = Hash::make($input['password']);


    $user = User::create($input);
    $user->assignRole($request->input('roles'));


    return redirect()->route('users.index')
                    ->with('success','User created successfully');
}


/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    $user = User::find($id);
    return view('users.show',compact('user'));
}


/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $user = User::find($id);
    $roles = Role::pluck('name','name')->all();
    $userRole = $user->roles->pluck('name','name')->all();


    return view('users.edit',compact('user','roles','userRole'));
}


/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'same:confirm-password',
        'roles' => 'required'
    ]);


    $input = $request->all();
    if(!empty($input['password'])){ 
        $input['password'] = Hash::make($input['password']);
    }else{
        $input = array_except($input,array('password'));    
    }


    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();


    $user->assignRole($request->input('roles'));


    return redirect()->route('users.index')
                    ->with('success','User updated successfully');
}


/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    User::find($id)->delete();
    return redirect()->route('users.index')
                    ->with('success','User deleted successfully');
}

public function profile()
{
  if (Auth::check())
  {
    return view('users.profile');
  }
  return redirect()->route('welcome');
}
public function myorders()
{
  if (Auth::check())
  {
    $user_id=Auth::user()->id;

    $result_allOrder=userOrder::where('user_id', '=', Auth::user()->id)
    ->with('gymdetail','orderDetail.packageDetails','orderDetail.membershipDetails')
    ->orderBy('id','DESC')
    ->get();
    //echo "<pre>";print_r($result_allOrder->toArray());die;
    return view('users.order',compact('result_allOrder'));
  }
   return redirect()->route('welcome');
}
 public function notification()
{
  if (Auth::check())
  {
    $user_id=Auth::user()->id;
    $myNutritions=assignNutrition::where(['user_id'=>$user_id,'status'=>'1'])
    ->with('sellerDetail')
    ->orderBy('id','DESC')
    ->get();
    //echo "<pre>";print_r($myNutritions->toArray());die;
    foreach ($myNutritions as $key => $value) {
      $nut_id=$value->id;
      $nut=assignNutrition::find($nut_id);
      $nut->seen='1';
      $nut->save();
      
      }
    
    $myWorkouts=assignWorkout::where(['user_id'=>$user_id,'status'=>'1'])
    ->orderBy('id','DESC')
    ->get();
    foreach ($myWorkouts as $key => $value) {
      $work_id=$value->id;
      $work=assignWorkout::find($work_id);
      $work->seen='1';
      $work->save();
      }
    //echo "<pre>";print_r($result_allOrder->toArray());die;
    return view('users.notification',compact('myNutritions','myWorkouts'));
  }
   return redirect()->route('welcome');
}


public function orderDetails($order_id)
{
 // echo $order_id;die;
  if (Auth::check() && isset($order_id))
  {
    $result_allOrder=userOrder::where('id', '=',$order_id)
    ->with('gymdetail.user','orderDetail.packageDetails','orderDetail.membershipDetails')
    ->get();
    //echo "<pre>";print_r($result_allOrder[0]['orderDetail'][0]['membershipDetails']['duration']);die;
    return view('users.confirm-payment',compact('result_allOrder'));
  }
  return redirect()->route('welcome');
}

public function availableStores($city,$cat_id)
{
    $filter=['city'=>$city,'store_status'=>'1'];
    $title='Available Stores';
    if(isset($city))
    {
       // $storeCategory=storeCategory::all();
        $stores_categories = Seller::Where($filter)
                  ->with('store_category')
                 ->select('*', DB::raw('count(*) as total_stores'))
                 ->groupBy('business_category')
                 ->get();

       //echo "<pre>";print_r($stores->toArray());die;
        $total=Seller::Where($filter)->count();
        if($total=='0')
        {
            $message="Sorry!!! Store not found around your location. Comming Soon .....";
            return redirect()->route('welcome')
                    ->with('error',$message);
        }

        
    }
    else
    {
        $message="We are not serving this city right now.We will comming soon";
        return redirect()->route('welcome')
                    ->with('error',$message);
        
    }
   
    if(isset($cat_id) && $cat_id !=0)
    {
       // $filter['category_id']=$cat_id;
        $cat=storeCategory::where('id',$cat_id)->first();
        $title=$cat->title;
    }
    else
    {
        $cat_id=0;
    }

    $yourlocationStores=Seller::Where($filter)
    ->with('locations','user','store_category')
    ->with(['products' => function ($query) {
          $query->where('status', '=', '1');
      }])
    ->get();
    //echo "<pre>";print_r($yourlocationgyms->toArray());die;
    return view('users.stores',compact('yourlocationStores','stores_categories','cat_id','title','total','city'));
}
public function productDetail(){
  return view('users.product-detail');   
}

}
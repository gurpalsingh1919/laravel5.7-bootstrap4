<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Seller;
use App\User;
use App\gymLocation;
use App\assignNutrition;
use App\productCategory;
use App\gymProduct;
use App\assignWorkout;
use App\attendance;
use App\gymPackage;
use App\gymPackageType;
use App\gymCity;
use App\gymCategory;
use App\gymFacility;
use App\membershipCancellation;
use App\gymMembership;
use App\storeCategory;
use DB;
use Hash;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use App\userOrder;
use App\orderPackage;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;
use Response;
class SellerController extends Controller
{
  	public function __construct()
    {
      $cities=gymCity::all();
      $sales='';
      $totalIncome='0';
     //$this->middleware('auth');
      //$this->middleware(function ($request, $next) {
      if(Auth::check() && Auth::user()->isSeller())
      {
          $user_id=Auth::user()->id;
          $gym_info = User::find($user_id)->seller;
          $seller_id=$gym_info->id;

          $sales=userOrder::where(['status'=>'1','gym_id'=>$seller_id])
           ->select(DB::raw('sum(net_payment) as `sales`')
          ,DB::raw('sum(seller_amount) as `seller_amount`')
          ,DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
          ->groupby('year','month')
          ->get();
          $totalIncome=userOrder::where(['status'=>'1','gym_id'=>$seller_id])
           ->select(DB::raw('sum(seller_amount) as `sales`'))->first();
            //echo "<pre>";print_r($sales->toArray());die;
            //echo $totalIncome;die;
          View::share(['salesArr'=>$sales,'totalIncome'=>$totalIncome]);
          return $next($request);
      }
    //});
       $storescategory=storeCategory::where('status','1')->get();
      View::share(['salesArr'=>$sales,'totalIncome'=>$totalIncome,'cities'=>$cities,'storeCategory'=>$storescategory]);
    }
    public function sellerlogin()
    {
      if(Auth::check() && Auth::user()->isSeller())
      {
         return redirect()->intended('/seller/dashboard');
      }
    	return view('sellers.login');
    }
    
    public function partnerwithus()
    {
    	if(Auth::check() && Auth::user()->isSeller())
      {
         return redirect()->intended('/seller/dashboard');
      }
      $cities=gymCity::all();
    	return view('sellers.partner-with-us',compact('cities'));
    }
    public function partner_with_Us()
    {
    	if(Auth::check() && Auth::user()->isSeller())
      {
         return redirect()->intended('/seller/dashboard');
      }
      $cities=gymCity::all();
      $categories=gymCategory::all();
    	return view('sellers.partnerWithUs',compact('cities','categories'));
    }

   

    
    public function sellerDashboard()
    {
    	$user_id=Auth::user()->id;
   		$gym_info = User::find($user_id)->seller;

      $seller_id=$gym_info->id;
      //echo  $seller_id;
      $packages=Seller::find($seller_id)->packages;

        $myOrders=userOrder::where(['gym_id'=> $seller_id,'status'=>'1'])
       // ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->get();
        $users=userOrder::where(['gym_id'=> $seller_id,'status'=>'1'])
        ->with('gymdetail','userDetail')
        ->groupBy('user_id')
        ->get();
       // $filter=['status'=>1,'gym_id'=>$seller_id]; seller_amount
      $salesArr=userOrder::where('status','=','1')
      ->where('gym_id','=',$seller_id)
      ->select(DB::raw('SUM(IFNULL(seller_amount, 0)) AS sales'), 
       DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
      ->groupby('year','month')
      ->get();

      $totalIncome=userOrder::where(['status'=>'1','gym_id'=>$seller_id])
        ->select(DB::raw('sum(seller_amount) as `sales`'))->first();

      //echo "<pre>";print_r($salesArr->toArray());die;
   		return view('newseller.dashboard',compact('gym_info','users','packages','myOrders','salesArr','totalIncome'));
   	}
    public function registerasseller(Request $request)
    {
      
      $this->validate($request,[
         'email'=>'required|email|unique:users,email',
         'name'=>'required',
         
         'phone_no'=>'required|min:10|numeric',
         'gym_name' =>'required|min:8',
         'gym_description' =>'required|min:8',
         'gym_address' => 'required',
         'zip' =>'required|digits:6|integer',
         'city' =>'required',
         'gym_licence' => 'required|max:10000|mimes:pdf,jpeg,png,jpg',
         'gym_images' => 'required|max:10000|mimes:jpeg,png,jpg',
         'gym_pan'=>'required|max:10000|mimes:pdf,jpeg,png,jpg',
         'category.*'=>'required',
         //'website_link'=>'nullable|regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
         'website_link'=>['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
      

     		]);


    		/************** Create USer *****************/

	    	$user= new User;
	    	$user->email= $request->email;
	    	$user->phone_no= $request->phone_no;
	    	$user->name= $request->name;
	    	$user->password=Hash::make('welcome@1');
	    	if($user->save())
	    	{
	    		$user_id=$user->id;
	    		$user->assignRole('seller');
	    		$gym_licence = $request->file('gym_licence');
		    	$gym_licencename = time().'-'.$user_id.'.'.$gym_licence->getClientOriginalExtension();
		    	$file_path = 'licences/';
		    	$gym_licence->move($file_path, $gym_licencename);

          $gym_pan = $request->file('gym_pan');
          $gym_pan_image = time().'-pan-'.$user_id.'.'.$gym_pan->getClientOriginalExtension();
          $gymspan_path = 'gyms/';
          $gym_pan->move($gymspan_path, $gym_pan_image);

		    	$gym_images = $request->file('gym_images');
		    	$gym_imagesname = time().'-'.$user_id.'.'.$gym_images->getClientOriginalExtension();
		    	$gymsfile_path = 'gyms/';
		    	$gym_images->move($gymsfile_path, $gym_imagesname);
	    		
	    	  	$seller = new Seller;
	    	  	$seller->user_id = $user_id;
	    	 	$seller->gym_name = $request->gym_name;
	    	 	$seller->gym_description =$request->gym_description;
	    	 	$seller->gym_address =$request->gym_address;
	    	 	$seller->zip =$request->zip;
	    	 	$seller->city =$request->city;
	    	 	$seller->gym_licence =$gym_licencename;
	    	 	$seller->gym_images =$gym_imagesname;
          $seller->pan_image =$gym_pan_image;
          $seller->website_link =$request->website_link;
          $seller->category_id =implode($request->category, '|');

	    	  	if($seller->save())
	    	  	{
              $location=array();
              if(isset($request->lat) && $request->lat !='' && isset($request->lon) && $request->lon !='')
              {
                $location['lat']=$request->lat;
                $location['lon']=$request->lon;
              }else
              {
                $address=$request->gym_address.' '.$request->city.' '.$request->zip;
              $location=$this->getGeocode($address);
              }
	    	  		
	    	  		$seller_id=$seller->id;
	    	  		$gmplocation= new gymLocation;
	    	  		$gmplocation->seller_id=$seller_id;
	    	  		$gmplocation->lat=$location['lat'];
	    	  		$gmplocation->lon=$location['lon'];
	    	  		$gmplocation->save();
	    	  	}
	    	}


	    	

	    	// die($seller->id);
			  //$this->sendActivationEmail($user,$text,$link);
	     	// $this->sendThanksEmail($user);
	      $message="<b>Thanks for taking interest in Near Gym:</b><br/>
				You have successfully submitted your document with us. We will check and let you know accordingly.";
	 		return redirect()->back()->with(['success' => $message]);
      
   }

    // function to get  the address
	function get_lat_long($address)
	{
		//echo "<pre>";print_r($_SERVER);die;
		//$address='2132 Ambedkar colony dhanas chandigarh 160014';
    	$address = str_replace(" ", "+", $address);
    	$url='https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false&key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4';
    	$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$json = curl_exec($curl);
		$json = json_decode($json);

    	$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    	//echo $lat.'---'.$long;die;
    	return array('lat'=>$lat,'lon'=>$long);
	}
	public function getGeocode($address)
   {

    	$res=app('geocoder')->geocode($address)->get();
    	//echo "<pre>";print_r($res->getCoordinates());die;

      //$geocoder->geocode('#2132 ambedkar colony dhanas chandigarh 160014, india')->get();
      if($res && is_array($res->all()[0]->toArray()))
      {
      	$result=$res->all()[0]->toArray();
      	$latitude=$result['latitude'];
      	$longitude=$result['longitude'];
      	return array('lat'=>$latitude,'lon'=>$longitude);
      }
      
      
   }
   public function findGymNearByYou(Request $request)
   {
   		//echo $request->address;
   		$result=$this->getGeocode($request->address);
   		//echo "<pre>";print_r($result->toArray());
      $lat=$result['lat'];
      $long=$result['lon'];
      ///echo $lat.'-----'.$long.'PI'.M_PI;
   		$yourlocationgyms= $this->getYourGyms($lat,$long);
     //echo "<pre>";print_r($result2);die;
     if(count($yourlocationgyms)>0)
     {
      $yourgyms='';
       //return view('sellers.located-gym',compact('yourlocationgyms'));
        foreach($yourlocationgyms as $gyms)
        {
          $yourgyms =$gyms['city'];   
        }
        $url=url("/yourgyms/{$yourgyms}");
        $data=array('status'=>1,'url'=>$url);
        return $data;
       
     }
     $message="Sorry !!! We are unable to find any gym in your location";
     $data=array('status'=>0,'message'=>$message);
     return  $data;
   }
   public function findGymNearByYouLocateMe(Request $request)
   {
      //echo $request->address;
      //$result=$this->getGeocode($request->address);
      //echo "<pre>";print_r($result->toArray());
      $lat=$request->lat;
      $long=$request->lon;
      ///echo $lat.'-----'.$long.'PI'.M_PI;
      $yourlocationgyms= $this->getYourGyms($lat,$long);
     //echo "<pre>";print_r($result2);die;
     if(count($yourlocationgyms)>0)
     {
      $yourgyms='';
       //return view('sellers.located-gym',compact('yourlocationgyms'));
        foreach($yourlocationgyms as $gyms)
        {
          $yourgyms =$gyms['city'];   
        }
        $url=url("/yourgyms/{$yourgyms}");
        $data=array('status'=>1,'url'=>$url);
        return $data;
       
     }
     $message="Sorry !!! We are unable to find any gym in your location";
     $data=array('status'=>0,'message'=>$message);
     return  $data;
   }
   
   public function getYourGyms($lat1, $lon1)
   { 
      //echo $lat1.'-----'.$lon2;die;
      $allSeller = Seller::Where(['status'=>'1','seller_type'=>'1'])->with('locations')->get();
      $totalSellers=array();
      foreach ($allSeller as $Seller) 
      {
        if(!empty($Seller->locations))
        {
          $lat2=$Seller->locations->lat;
          $lon2=$Seller->locations->lon;
          $unit="K";
          //echo $lat2.'-----'.$lon2;
          $distance=$this->distance($lat1, $lon1, $lat2, $lon2, $unit);
          //echo $distance;die;
          if($distance < 10)
          {
            $totalSellers[]=$Seller->toArray();

          }
        }
      }
      return $totalSellers;
      //echo "<pre>";print_r($totalSellers);die;
    }
   public function distance($lat1, $lng1, $lat2, $lng2, $unit) 
    {
      //echo $lat1.','. $lon1.','. $lat2.','. $lon2.','. $unit;die;
      $pi80 = M_PI / 180;
      $lat1 = $lat1 * $pi80;
      $lng1 = $lng1*$pi80;
      $lat2 = $lat2 * $pi80;
      $lng2 = $lng2*$pi80;
      //echo $lat1.'-------'.$lat2;die;
      $r = 6372.797; // mean radius of Earth in km
      $dlat = $lat2 - $lat1;
      $dlng = $lng2 - $lng1;
      $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
      $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
       
      return $km = $r * $c;
    }
    public function findTrainerNearByMyLocation(Request $request)
    {
      $lat=$request->lat;
      $long=$request->lon;
      $yourlocationgyms= $this->getYourTrainers($lat,$long);
     //echo "<pre>";print_r($result2);die;
     if(count($yourlocationgyms)>0)
     {
      $yourtrainers='';
       //return view('sellers.located-gym',compact('yourlocationgyms'));
        foreach($yourlocationgyms as $gyms)
        {
          $yourtrainers =$gyms['city'];   
        }
        $url=url("/yourtrainers/{$yourtrainers}");
        $data=array('status'=>1,'url'=>$url);
        return $data;
       
     }
     $message="Sorry !!! We are unable to find any trainer at your location";
     $data=array('status'=>0,'message'=>$message);
     return  $data;
    }
    public function getYourTrainers($lat1, $lon1)
   { 
      //echo $lat1.'-----'.$lon2;die;
      $allSeller = Seller::Where(['status'=>'1','seller_type'=>'2'])
      ->with('locations')
      ->get();
      $totalSellers=array();
      foreach ($allSeller as $Seller) 
      {
        if(!empty($Seller->locations))
        {
          $lat2=$Seller->locations->lat;
          $lon2=$Seller->locations->lon;
          $unit="K";
          //echo $lat2.'-----'.$lon2;
          $distance=$this->distance($lat1, $lon1, $lat2, $lon2, $unit);
          //echo $distance;die;
          if($distance < 10)
          {
            $totalSellers[]=$Seller->toArray();

          }
        }
      }
      return $totalSellers;
      //echo "<pre>";print_r($totalSellers);die;
    }
    public function findStoresNearByMyLocation(Request $request)
    {
      $lat=$request->lat;
      $long=$request->lon;
      $yourlocationstores= $this->getYourStores($lat,$long);
    // echo "<pre>";print_r($yourlocationstores);die;
     if(count($yourlocationstores)>0)
     {
      $yourstores='';
       //return view('sellers.located-gym',compact('yourlocationgyms'));
        foreach($yourlocationstores as $store)
        {
          $yourstores =$store['city'];   
        }
        $url=url("/product-stores/{$yourstores}");
        $data=array('status'=>1,'url'=>$url);
        return $data;
       
     }
     $message="Sorry !!! We are unable to find any stores at your location";
     $data=array('status'=>0,'message'=>$message);
     return  $data;
    }
    public function getYourStores($lat1, $lon1)
   { 
      //echo $lat1.'-----'.$lon2;die;
      $allStores = Seller::Where(['store_status'=>'1'])
      ->with('locations')
      ->get();
     // echo "<pre>";print_r($allStores->toArray());die;
      $totalStores=array();
      foreach ($allStores as $store) 
      {
        if(!empty($store->locations))
        {
          $lat2=$store->locations->lat;
          $lon2=$store->locations->lon;
          $unit="K";
          //echo $lat2.'-----'.$lon2;
          $distance=$this->distance($lat1, $lon1, $lat2, $lon2, $unit);
          //echo $distance;die;
          if($distance < 10)
          {
            $totalStores[]=$store->toArray();

          }
        }
      }
      return $totalStores;
      //echo "<pre>";print_r($allStores->toArray());die;
    }
	public function packagesList(Request $request)
	{
     
	 	  $user_id=Auth::user()->id;
   		$gym_info = User::find($user_id)->seller;
      $seller_id=$gym_info->id;
      $packages=Seller::find($seller_id)->packages;
      if(isset($request->category) && $request->category !=0)
      {
        $packages=Seller::find($seller_id)->packages->where('package_type_id','=',$request->category);
      }
	 	 
     // $packages=Seller::where('id','=',$seller_id)->with('packages')->get();
    //   $users = Seller::where('id','=',$seller_id)->with('packages', function($q){
    //     $q->where('package_type_id', '=', '1');
    // })->get();
	 	  //echo $seller_id."<pre>";print_r($packages->toArray());die;
	 	  return view('newseller.packages',compact('packages','gym_info'));
	}
	public function packagesAdd()
	{
	 	$user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $cancellations=membershipCancellation::all();
    return view('newseller.add-package',compact('packages_types','gym_info','cancellations'));
	}
  public function updateMyGymDetail()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $categories=gymCategory::all();
    $gymFacility=gymFacility::all();

    return view('newseller.general-settings',compact('gym_info','categories','gymFacility'));
  }
  public function updateMyGymPost(Request $request)
  {

    //echo "<pre>";print_r($request->all());die;
     $user_id=Auth::user()->id;
     $this->validate($request,[
            'gym_name'=>'required',
            'gym_description'=>'required|min:8',
            'gym_timing'=>'required',
            
            //'gym_images' =>'max:10000|mimes:jpeg,png,jpg',
            'category.*'=>'required',
            'facilities'=>'required',
            'gym_images.*' => 'max:10000|mimes:jpeg,png,jpg',
            'gym_video'   =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:200040'
          ]);
          $images=array();
        if($request->hasFile('gym_images'))
        {
          if($files=$request->file('gym_images'))
          {
            $i=1;
            foreach($files as $file)
            {
               //echo "<pre>";print_r($file);
               $filename = time() .'-'.$i. '.' . $file->getClientOriginalExtension();
                $file->move('gyms/',$filename);
                $images[]=$filename;
                $i++;
            }
          }
        }   
        $video='';
        if($files=$request->file('gym_video'))
        {
          $filename = time() .'-video'.'.'.$files->getClientOriginalExtension();
          $files->move('gyms/',$filename);
          $video=$filename;
        }
        $timing=array();
        foreach ($request->gym_timing as $key => $value) 
        {
          if(isset($value['start_time']) && isset($value['end_time']))
          {
            $val=$value['start_time'].' - '.$value['end_time'];
          }
          else if(isset($value['close']))
          {
             $val=$value['close'];
          }
          $timing[$key]=$val;
          
        }  
        $allfaclity=gymFacility::all();
        $facility=array();
        foreach ($allfaclity as $key => $value) {
          $facility[]=$value->name;
        }
        foreach($request->facilities as $val)
        {
          if(!in_array($val, $facility))
          {
            $faculty=new gymFacility;
            $faculty->name=$val;
            $faculty->save();
          }
          
        }
          
       // echo "<pre>";print_r($facility); print_r($request->all());die;

          $gym_info = User::find($user_id)->seller;
          $gym_info->gym_name=$request->gym_name;
          $gym_info->gym_description=$request->gym_description;
          $gym_info->category_id =implode($request->category, '|');
          $gym_info->facilities =implode($request->facilities, '|');
          $gym_info->timing=json_encode($timing);
          if(!empty($images))
          {
             $gym_info->gym_images= implode("|",$images);
          }
          if(!empty($video))
          {
              $gym_info->video_link=$video;
          }
         
          /*if($request->hasFile('gym_images'))
          {
              $file = $request->file('gym_images');
              $filename = time() .'- gym'. $file->getClientOriginalExtension();
              $file->move('gyms/',$filename);
              $gym_info->gym_images=$filename;
          }*/
          
         
          if($gym_info->save())
          {
              $message="<b>You have successfully updated your gym detail.</b>";
              return redirect()->back()->with(['success' => $message]);

          }

  }
	public function addPackagePost(Request $request)
	{
	 	 $this->validate($request,[
            'title'=>'required',
            'description'=>'required|min:8',
            'memberships'=>'required',
            'membership_image'=>'required| max:10485760|mimes:jpeg,png,jpg',
            'cancellation' => 'required',
            'refund' => 'required',
          ]);
        //echo "<pre>";print_r($request->all());die;
        $ms_image='';
        if($request->hasFile('membership_image'))
        {
          $file=$request->file('membership_image');
          $ms_image = time() .'-'.rand(1, 1000000). '.' .$file->getClientOriginalExtension();
          $file->move('package/',$ms_image);
        }
        // echo "<pre>";print_r($request->file('package_images'));
        //echo "<pre>";print_r($images);die;
            $user_id=Auth::user()->id;
            $gym_info = User::find($user_id)->seller;
            $seller_id=$gym_info->id;
            $gymPackage= new gymPackage;
            $gymPackage->title= $request->title;
            $gymPackage->seller_id= $seller_id;
            $gymPackage->description= $request->description;
            $gymPackage->cancellation= $request->cancellation;
            $gymPackage->refund= $request->refund;
            $gymPackage->image=  $ms_image;
            if($gymPackage->save())
            {
              $package_id=$gymPackage->id;
              $memberships=$request->memberships;
              foreach ($memberships as $key => $value) {
                $memberships=new gymMembership;
                $memberships->duration=$key;
                $memberships->price=$value;
                $memberships->package_id=$package_id;
                $memberships->save();

              }
              

                $message="<b>You have successfully added a package:</b><br/>
                After admin approval your package will be listed in your gym.";
                return redirect()->back()->with(['success' => $message]);

            }

	}
	public function editPackage($id)
	{
		$user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $freelancer_id=$gym_info->id;
    $packagedetail=gymPackage::where(['id'=>$id,'seller_id'=>$freelancer_id])
    // ->with('packageMemberships')
    // ->whereHas('packageMemberships', function ($query) use($id) {
    //   $query->where(['status'=>'2']);})
    ->with(['packageMemberships' => function ($query) {
          $query->where('status', '=', '1');
      }])
    ->first();
    $cancellations=membershipCancellation::all();
    //echo "<pre>";print_r($packagedetail->toArray());die;
    return view('newseller.edit-package',compact('packagedetail','packages_types','gym_info','cancellations'));
	}
	public function updatePackage(Request $request, $id)
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $seller_id=$gym_info->id;
      if($seller_id == request('seller_id'))
      {
          $this->validate($request,[
            'title'=>'required',
            'description'=>'required|min:8',
            'memberships'=>'required',
            //'membership_image'=>'required| max:10485760|mimes:jpeg,png,jpg',
            'cancellation' => 'required',
            'refund' => 'required',
            
             
         ]);

        $gymPackage = gymPackage::find($id);
        $gymPackage->title= $request->title;
        $gymPackage->description= $request->description;
        $gymPackage->cancellation=$request->cancellation;
        $gymPackage->refund=$request->refund;
        $gymPackage->status='0';
        $ms_image='';
        if($request->hasFile('membership_image'))
        {
          $file=$request->file('membership_image');
          $ms_image = time() .'-'.rand(1, 1000000). '.' .$file->getClientOriginalExtension();
          $file->move('package/',$ms_image);
          $gymPackage->image=$ms_image;
        
        }
        if($gymPackage->save())
        {
            $package_id=$id;
            $ms_new=$request->memberships;
            $ms_previous=gymMembership::where('package_id',$package_id)->get();
            $pre_arr=array();
            foreach ($ms_previous as $prekey => $preval) 
            {
              $preid=$preval->id;
              $premembership=gymMembership::find($preid);
              $premembership->status='2';
              $premembership->save();
              $pre_arr[]=$preid;
            }
            $i=0;
            foreach ($ms_new as $key => $value) 
            {
              if(isset($pre_arr[$i]))
              {
                $preid=$pre_arr[$i];
                $premembership=gymMembership::find($preid);
                $premembership->duration=$key;
                $premembership->price=$value;
                $premembership->status='1';
                $premembership->save();
              }
              else
              {
                $memberships=new gymMembership;
                $memberships->duration=$key;
                $memberships->price=$value;
                $memberships->package_id=$package_id;
                $memberships->save();
              }
              $i++;
            }
            $message="<b>You have successfully updated a package detail:</b><br/>
                After admin approval your package will be listed in your gym.";
            return redirect()->back()->with(['success' => $message]);
        }
        
      }
      else
      {
        $message="You are not authorize to edit this package:";
        return redirect()->back()->with(['error' => $message]);
      }
   	
  }


	public function rate_delete($id)
  {
      $rate = gymPackage::where('id',$id)->delete();
      return redirect('sellers.packages')->with('success','Package Deleted Successfully');
  }

  public function getMyCustomer()
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;

     $myOrders=userOrder::where(['gym_id'=> $gym_id,'status'=>'1'])
        ->with('gymdetail','userDetail')
        ->groupBy('user_id')
        ->get();
      //echo "<pre>";print_r($myOrders->toArray());die;
      return view('newseller.my-customers',compact('myOrders','gym_info'));
  }
  public function getmyorder(Request $request)
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;

      $filter=['gym_id'=> $gym_id,'status'=>'1'];
      if(!empty($request->user) && $request->user !='0')
      {
        $filter['user_id'] =$request->user;
      }
      if(!empty($request->daterange) && $request->daterange !='0')
      {
        $date=explode("to", $request->daterange);
       
        
        $filter[] =['created_at', '>=', $date[0]];
        $filter[] =['created_at', '<=', $date[1]];
      }

    
      //echo "<pre>";print_r($gym_info->toArray());die;
      $myOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->orderBy('id','DESC')
        ->get();
      $users=userOrder::where(['gym_id'=> $gym_id,'status'=>'1'])
        ->with('userDetail')
        ->groupBy('user_id')
        ->get();
     // echo "<pre>";print_r($myOrders->toArray());die;
      return view('newseller.my-orders',compact('myOrders','gym_info','users'));
  }
  public function changepassword()
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;
       return view('newseller.change-password',compact('gym_info'));
  }
  public function getmywallet(Request $request)
  {
     $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $gym_id=$gym_info->id;

      $filter=['status'=>'1','gym_id'=> $gym_id];
       $mycustomers=userOrder::where($filter)
        ->with('gymdetail','userDetail')
        ->groupBy('user_id')
        ->get();
      if(!empty($request->user) && $request->user !='0')
      {
        $filter['user_id'] =$request->user;
      }
      if(!empty($request->datefilter) && $request->datefilter !='0')
      {
        $date=explode("-", $request->datefilter);
        //echo "<pre>";print_r($date);
        if(isset($date[0]))
        {
          $da=explode("/", $date[0]);
          $created_at1=trim($da[2]).'-'.$da[0].'-'.$da[1];
        }
        if(isset($date[1]))
        {
          $da1=explode("/", $date[1]);
          $created_at2=$da1[2].'-'.trim($da1[0]).'-'.$da1[1];
        }
        $filter[] =['created_at', '>=', $created_at1];
        $filter[] =['created_at', '<=', $created_at2];
       // echo "<pre>";print_r($filter);die;
      }


      


       $totalSale=userOrder::where($filter)
       ->where(['seller_payment_status'=>'1'])
       ->sum('seller_amount');

       $sellerPendingAmount=userOrder::where($filter)
       ->where(['seller_payment_status'=>'0'])
       ->sum('seller_amount');

      $myOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->get();
     //echo "<pre>";print_r($myOrders->toArray());die;
      return view('newseller.my-wallet',compact('myOrders','gym_info','totalSale','sellerPendingAmount','mycustomers'));
  }
  
  public function getmyordersummary($order_id)
    {
      $filter=['id'=>$order_id];
       $orderdetail=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->get();
       // echo "<pre>";print_r($orderdetail->toArray());die;
        return view('sellers.order-summary',compact('orderdetail'));

    }


    public function getAllNutrition()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $gym_id=$gym_info->id;
    $mynutritions=assignNutrition::where(['assigne_id'=> $gym_id,'status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('newseller.nutrition',compact('mynutritions'));
  }
  public function assignNutritionToCustomer(Request $request)
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;

     // $mycustomers=userOrder::where(['gym_id'=> $gym_id,'status'=>'1'])
     //    ->with('gymdetail','userDetail')
     //    ->groupBy('user_id')
     //    ->get();
      $myPackages=orderPackage::with('packageDetails','orderDetails')->
      whereHas('orderDetails', function ($query) use ($gym_id) {
          $query->where(['status'=>'1','gym_id'=>$gym_id]);})
        //->whereHas('packageDetails', function ($query) use ($gym_id) {
          //$query->where(['status'=>'1','seller_id'=>$gym_id]);})
        ->groupBy('gym_package_id')
        ->get();
      $filter=array("gym_package_id"=>"0");
      $packag_id=0;
      if(isset($request->package) && $request->package !='0')
      {
        $packag_id=$request->package;
        $filter["gym_package_id"]=$request->package;
      } 
     
      $mycustomers=orderPackage::where($filter)
      ->with('packageDetails','orderDetails.userDetail')
      ->whereHas('orderDetails', function ($query) use ($gym_id) {
          $query->where(['status'=>'1','gym_id'=>$gym_id]);})
      ->get();
        //echo "<pre>";print_r($myOrders->toArray());die;
      return view('newseller.nutritionassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function deleteAssignedNutrition(Request $request)
  {
    //echo "<pre>";print_r($request->all());die;
    if($request->nutrition_id)
    {
      $user_id=Auth::user()->id;
      $nutrition=assignNutrition::where(['id'=> $request->id,'assigne_id'=>$user_id])
        ->get();
      if($nutrition)
      {
          $nutritions=assignNutrition::find($request->nutrition_id);
          $nutritions->status='0';
          $nutritions->save();
          $arr=array("status"=>"success","message"=>"Nutrition has been deleted successfully.");
          
      }
      else
      {
        $arr=array("status"=>"error","message"=>"You are not authorize to make this action !!");
      }
    }
    else
    {
       $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
    }
    return  Response::json( $arr );
      
     
  }
  public function assignNutritionPost(Request $request)
  {
      $this->validate($request,[
            'customer'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'week_days' => 'required',
            'nutrition' => 'required'
         ]);
      //echo "<pre>";print_r(json_encode(array_keys($request->week_days)));die;
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;
      if(isset($request->customer) && is_array($request->customer))
      {
        $customer_ids=$request->customer;
        $alreadyAssign=assignNutrition::where(["start_date"=>$request->start_date,"end_date"=>$request->end_date])
        ->whereIn('user_id', $customer_ids)
        ->get();
        if(count($alreadyAssign)>0)
        {
          $message="<b>One or all of the customers you have selected, Nutrition already has been assign for the selected dates.</b>";
          return redirect()->back()->with(['success' => $message]);
        }
        $customers=$request->customer;
        foreach ($customers as $customer) 
        {
          $assigNutrition= new assignNutrition;
          $assigNutrition->user_id=$customer;
          $assigNutrition->assigne_id=$gym_id;
          $assigNutrition->video=$request->video;
          $assigNutrition->start_date=$request->start_date;
          $assigNutrition->end_date=$request->end_date;
          $assigNutrition->week_days=json_encode(array_keys($request->week_days));
          $assigNutrition->nutritions=json_encode($request->nutrition);
          $assigNutrition->save();
        }
        $message="<b>You have successfully assign a Nutrition</b>";
        return redirect()->back()->with(['success' => $message]);
      }
      else
      {
        $message="<b>Something went error. Please try after some time.</b>";
        return redirect()->back()->with(['error' => $message]);
      }
      //echo "<pre>";print_r($request->all());die;
  }
  public function getAllWorkouts()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $gym_id=$gym_info->id;
    $myworkouts=assignWorkout::where(['assigne_id'=> $gym_id,'status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")
    ->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('newseller.workoutlog',compact('myworkouts'));
  }
  public function assignWorkoutToNewUSer(Request $request)
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;

     // $mycustomers=userOrder::where(['gym_id'=> $gym_id,'status'=>'1'])
     //    ->with('gymdetail','userDetail')
     //    ->groupBy('user_id')
     //    ->get();
      $myPackages=orderPackage::with('packageDetails','orderDetails')->
      whereHas('orderDetails', function ($query) use ($gym_id) {
          $query->where(['status'=>'1','gym_id'=>$gym_id]);})
        //->whereHas('packageDetails', function ($query) use ($gym_id) {
          //$query->where(['status'=>'1','seller_id'=>$gym_id]);})
        ->groupBy('gym_package_id')
        ->get();
      $filter=array("gym_package_id"=>"0");
      $packag_id=0;
      if(isset($request->package) && $request->package !='0')
      {
        $packag_id=$request->package;
        $filter["gym_package_id"]=$request->package;
      } 
     
      $mycustomers=orderPackage::where($filter)
      ->with('packageDetails','orderDetails.userDetail')
      ->whereHas('orderDetails', function ($query) use ($gym_id) {
          $query->where(['status'=>'1','gym_id'=>$gym_id]);})
      ->get();
        //echo "<pre>";print_r($myOrders->toArray());die;
      return view('newseller.workoutassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function assignWorkoutPost(Request $request)
  {
    $this->validate($request,[
            'customer'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'week_days' => 'required',
            'workout' => 'required',
            'description'=>'required'
         ]);
    //echo "<pre>";print_r(json_encode($request->workout));die;
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;
      if(isset($request->customer) && is_array($request->customer))
      {
        $customer_ids=$request->customer;
        $alreadyAssign=assignWorkout::where(["start_date"=>$request->start_date,"end_date"=>$request->end_date])
        ->whereIn('user_id', $customer_ids)
        ->get();
        if(count($alreadyAssign)>0)
        {
          $message="<b>One or all of the customers you have selected, Workout already has been assign for the selected dates.</b>";
          return redirect()->back()->with(['success' => $message]);
        }
        $customers=$request->customer;
        foreach ($customers as $customer) 
        {
          $assignWorkout= new assignWorkout;
          $assignWorkout->user_id=$customer;
          $assignWorkout->assigne_id=$gym_id;
          $assignWorkout->start_date=$request->start_date;
          $assignWorkout->end_date=$request->end_date;
          $assignWorkout->description=$request->description;
          $assignWorkout->week_days=json_encode(array_keys($request->week_days));
          $assignWorkout->workouts=json_encode($request->workout);
          $assignWorkout->video_link=$request->video;
          $assignWorkout->save();
        }
        $message="<b>You have successfully assign a Workout</b>";
        return redirect()->back()->with(['success' => $message]);
      }
      else
      {
        $message="<b>Something went error. Please try after some time.</b>";
        return redirect()->back()->with(['error' => $message]);
      }
    
  }
  public function deleteAssignedWorkouts(Request $request)
  {
    //echo "<pre>";print_r($request->all());die;
    if($request->workout_id)
    {
      $user_id=Auth::user()->id;
      $workouts=assignWorkout::where(['id'=> $request->id,'assigne_id'=>$user_id])
        ->get();
      if($workouts)
      {
          $workout=assignWorkout::find($request->workout_id);
          $workout->status='0';
          $workout->save();
          $arr=array("status"=>"success","message"=>"Workout has been deleted successfully.");
          
      }
      else
      {
        $arr=array("status"=>"error","message"=>"You are not authorize to make this action !!");
      }
    }
    else
    {
       $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
    }
    return  Response::json( $arr );
      
     
  }
  /*public function getAttendance(Request $request)
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $freelancer_id=$gym_info->id;
    $packages=Seller::find($freelancer_id)->packages;
    $package_id='';
    $pack_name='';
    $mycustomers=array();
    if(!empty($request->package_id))
    {
        $package_id=$request->package_id;
        $mycustomers=orderPackage::where(['gym_package_id'=> $request->package_id])
        ->with('orderDetails','orderDetails.userDetail')
        //->groupBy('order_details.user_id')
        ->get();
        $packdetail=gymPackage::find($package_id);
        $pack_name=$packdetail->title;
        $dateformat=str_replace(".","-",$request->date);
        $yrdata= strtotime($dateformat);
        $formatted_date=date("F jS, Y",$yrdata);
        //echo $freelancer_id."<pre>";print_r($packdetail->title);die;
    }
    //echo "<pre>";print_r($packages->toArray());die;
    return view('trainer.mark-attendance',compact('packages','mycustomers','freelancer_id','package_id','pack_name','formatted_date'));
  }*/
  public function checkCustomerAttendance(Request $request)
  {
     $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $freelancer_id=$gym_info->id;
    $packages=Seller::find($freelancer_id)->packages;
    $package_id='';
    $pack_name='';
    $mycustomers=array();
    $present=array();
    if(!empty($request->package_id))
    {
        $package_id=$request->package_id;
        $date=$request->date;
        $mycustomers=orderPackage::where(['gym_package_id'=> $request->package_id])
        ->with('orderDetails','orderDetails.userDetail')
        ->whereHas('orderDetails', function ($query) use ($freelancer_id) {
        $query->where(['status'=>'1','gym_id'=>$freelancer_id]);})
        ->get();

        $customer_attendance=attendance::where(['package_id'=> $package_id,'attendance_date'=>$date])->orderBy('id', 'DESC')->get();
        if(!$customer_attendance->isEmpty())
        {
          $attendance=$customer_attendance->toArray();
          $present=json_decode($attendance[0]['attendance']);
        }
        //echo "<pre>";print_r($present);die;
        $packdetail=gymPackage::find($package_id);
        $pack_name=$packdetail->title;
        $dateformat=str_replace(".","-",$request->date);
        $yrdata= strtotime($dateformat);
        $formatted_date=date("F jS, Y",$yrdata);
        //echo $freelancer_id."<pre>";print_r($packdetail->title);die;
    }
   //echo "<pre>";print_r($mycustomers->toArray());die;
    return view('newseller.attendance',compact('packages','mycustomers','present','freelancer_id','package_id','pack_name','formatted_date'));
  }
  public function markUserAttandance(Request $request)
  {
      $this->validate($request,[
            'package_id'=>'required',
            'attendance_date'=>'required',
            'attendance'=>'required',
            
         ]);
    $user_id=Auth::user()->id;
    $package_id=$request->package_id;
    $date=$request->attendance_date;
    $customer_attendance=attendance::where(['package_id'=> $package_id,'attendance_date'=>$date])->orderBy('id', 'DESC')->get();
    if(!$customer_attendance->isEmpty())
    {
      $attendance=$customer_attendance->toArray();
      $present_id=$attendance[0]['id'];
      $attendance=attendance::find($present_id);
      $attendance->attendance=json_encode(array_keys($request->attendance));
      if($attendance->save())
      {
        $message="<b>Attendance has been marked for selected date.</b>";
        return redirect()->back()->with(['success' => $message]);
      }
    }
    else
    {
      $attendance= new attendance;
      $attendance->package_id=$request->package_id;
      $attendance->attendance_date=$request->attendance_date;
      $attendance->attendance=json_encode(array_keys($request->attendance));
      $attendance->assigne_id=$user_id;
      if($attendance->save())
      {
        $message="<b>Attendance has been marked for selected date.</b>";
        return redirect()->back()->with(['success' => $message]);
      }
    }
      
  }
  public function addProduct()
  {
    $productCategory=productCategory::all();
    return view('newseller.add-product',compact('productCategory'));
  }
  public function addNewProductPost(Request $request)
  {
    //echo "<pre>";print_r($request->all());die;
      $this->validate($request,[
        'product_images'=>'required',
        'product_images.*'=>'max:10000|mimes:jpeg,png,jpg',
        'product_name'=>'required',
        'product_description'=>'required|min:10',
        'product_category'=>'required',
        'product_color'=>'required',
        'product_size'=>'required',
        'product_price'=>'required',
        'available_quantity'=>'required',
        // 'available_quantity'=>'required',
        
     ]);
       
      if($request->hasFile('product_images'))
      {
        $files=$request->file('product_images');
        $i=1;
        foreach($files as $file)
        {
          $filename = time() .'-'.$i. '.' . $file->getClientOriginalExtension();
          $file->move('product/',$filename);
          $images[]=$filename;
          $i++;
        }
      }

    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;

    $gymProduct=new gymProduct();
    $gymProduct->name=$request->product_name;
    $gymProduct->seller_id=$seller_id;
    $gymProduct->description=$request->product_description;
    $gymProduct->category=$request->product_category;
    $gymProduct->colors=json_encode($request->product_color);
    $gymProduct->size=json_encode($request->product_size);
    $gymProduct->price=$request->product_price;
    $gymProduct->discount=$request->discount;
    $gymProduct->weight=$request->weight;
    $gymProduct->quantity=$request->available_quantity;
    $gymProduct->status='0';
    $gymProduct->images=json_encode($images);
    if($gymProduct->save())
    {
      $message="<b>You have successfully submitted a product. Please wait for admin approval. After admin approval you can see your product in frontend.</b>";
        return redirect()->back()->with(['success' => $message]);
    }

  }
  public function updateProduct(Request $request,$product_id)
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    if(isset($product_id))
    {
      $productCategory=productCategory::all();
      $productDetail=gymProduct::where(['seller_id'=>$seller_id,'id'=>$product_id])->first();
      if($productDetail)
      {
        if($request->update)
        {
          $productDetail->name=$request->product_name;
          $productDetail->description=$request->product_description;
          $productDetail->category=$request->product_category;
          $productDetail->colors=json_encode($request->product_color);
          $productDetail->size=json_encode($request->product_size);
          $productDetail->price=$request->product_price;
          $productDetail->discount=$request->discount;
          $productDetail->weight=$request->weight;
          $productDetail->quantity=$request->available_quantity;
          $productDetail->status='0';
          $images=array();
          if($request->hasFile('product_images'))
          {
            $files=$request->file('product_images');
            $i=1;
            foreach($files as $file)
            {
              $filename = time() .'-'.$i. '.' . $file->getClientOriginalExtension();
              $file->move('product/',$filename);
              $images[]=$filename;
              $i++;
            }
          }
          if(count($images)>0)
          {
            $productDetail->images=json_encode($images);
          }
          
          if($productDetail->save())
          {
            $message="<b>You have successfully submitted a product. Please wait for admin approval. After admin approval you can see your product in frontend.</b>";
              return redirect()->back()->with(['success' => $message]);
          }
         
         // echo "<pre>";print_r($request->all());die;
        }
        return view('newseller.edit-product',compact('productDetail','productCategory','product_id'));
      }
      else
      {
        redirect()
        ->route('getMyProductList')
        ->with('success','You are not authorize to update this product.');
      }
      
    }
    else
    {
        redirect()
        ->route('getMyProductList')
        ->with('success','Something missing please try after sometime.');
    }
   
  }
  public function deleteMyProduct(Request $request)
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    if($request->product_id)
    {
      $user_id=Auth::user()->id;
      $product=gymProduct::where(['id'=> $request->product_id,'seller_id'=>$seller_id])
        ->first();
      if($product)
      {
          $product->status='3';
          $product->save();
          $arr=array("status"=>"success","message"=>"Nutrition has been deleted successfully.");
          
      }
      else
      {
        $arr=array("status"=>"error","message"=>"You are not authorize to make this action !!");
      }
    }
    else
    {
       $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
    }
    return  Response::json( $arr );
  }
  public function getMyProduct()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    $gymProduct=gymProduct::where(['seller_id'=>$seller_id])
    ->where('status','!=','3')
    ->get();
    return view('newseller.my-products',compact('gymProduct'));
  }
  public function getStore(Request $request)
  {

     $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    $business_detail=Seller::find($seller_id);
    return view('newseller.my-store',compact('business_detail'));
  }
  public function createStoreRequest(Request $request)
  {

    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    $this->validate($request,[
            'business_name'=>'required|unique:sellers,business_name,'.$seller_id.',id',
            'business_url'=>'required|unique:sellers,business_url,'.$seller_id.',id',
            'business_type'=>'required',
            'business_category'=>'required',
            
         ]);

    $seller=Seller::find($seller_id);
    $seller->business_name=$request->business_name;
    $seller->business_url=$request->business_url;
    $seller->business_type=$request->business_type;
    $seller->business_category=$request->business_category;
    $seller->store_status='3';
    if($seller->save())
    {
        $message="<b>You have successfully submitted store request. Please wait for admin approval. After admin approval you can add product.</b>";
        return redirect()->back()->with(['success' => $message]);
    }
    //echo "<pre>";print_r($request->all());die;

      //return view('newseller.add');

  }

    


}



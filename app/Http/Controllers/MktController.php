<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\gymCity;
use App\freelancer;
use Hash;
use App\Seller;
use DB;
use App\gymLocation;
use App\assignNutrition;
use App\productCategory;
use App\gymProduct;
use App\assignWorkout;
use App\attendance;
use App\gymPackage;
use App\gymPackageType;
use App\membershipCancellation;
use App\gymMembership;
use App\gymCategory;
use Illuminate\Support\Facades\Auth;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use App\userOrder;
use App\orderPackage;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;
class MktController extends Controller
{
	public function __construct()
  {
    $cities=gymCity::all();
    $gymCategory=gymCategory::all();

    View::share(['cities'=>$cities,'gymCategory'=>$gymCategory]);
    $this->seller=new SellerController;
  }
  public function salesExecutiveLogin()
  {
    return view('mkt-executive.login');
  }
  public function dashboard()
  {
    if (Auth::check() && Auth::user()->isSalesExecutive())
    {
      $exe_id=Auth::user()->id;
      $filter=['seller_type'=>'1','registered_by'=>'2','salesexecutive_id'=>$exe_id];
      $Sellers=Seller::where('status','!=','2')->where($filter)->count();
      $Packages=gymPackage::where('status','!=','2')->where(['registered_by'=>'2','salesexecutive_id'=>$exe_id])->count();
      //echo $Seller;die;
      //echo "<pre>";print_r($sales->toArray());die;
      return view('mkt-executive.dashboard',compact('Sellers','Packages'));
    }
  	
  } 
  
    public function MyGeneralsettings(Request $request)
    {
      $user_id=Auth::user()->id;
      $executive_info = User::find($user_id);
     //echo "<pre>";print_r($executive_info->toArray());die;
      return view('mkt-executive.general-settings',compact('executive_info','cities'));
    }
    public function updateMySettings(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
      $user_id=Auth::user()->id;
      $this->validate($request,[
     'first_name'=>'required',
     'last_name'=>'required',
     'contact_no'=>'required|min:6|numeric',
     'username'=>'required',
     
      ]);

        $user=  User::find($user_id);
        $user->name= $request->first_name .' '.$request->last_name;
        $user->phone_no= $request->contact_no;
        $user->username= $request->username;
        if($user->save())
        {
          $message="<b>You have successfully updated your detail."; 
          return redirect()->back()->with(['success' => $message]);
        }
    }
    public function changepassword()
    {
      $user_id=Auth::user()->id;
      return view('mkt-executive.change-password');
    }
    public function myWallet()
    {
      $exe_id=Auth::user()->id;
      $filter=['seller_type'=>'1','registered_by'=>'2','salesexecutive_id'=>$exe_id];
      $mysellers=Seller::where($filter)->where('status','!=','2')->with('user')->get();
      $title="My Seller's Gym";
      return view('mkt-executive.my-wallet',compact('mysellers'));
    }
    public function createNewSeller()
    {
      $title="Seller Registration";
      return view('mkt-executive.create-seller',compact('title'));
    }
    public function getMySellers(Request $request)
    {
      $exe_id=Auth::user()->id;
      $filter=['seller_type'=>'1','registered_by'=>'2','salesexecutive_id'=>$exe_id];
      if(!empty($request->city) && $request->city !='0')
      {
          $filter['city'] =$request->city;
      }
        $cat_id='0';
        if(!empty($request->category) && $request->category !='0')
        {
          $cat_id=$request->category;
        }
        $mysellers=Seller::where($filter)
        ->where('status','!=','2')
        ->with('user')
        ->orderBy('id','DESC')
        ->get();
        $title="My Seller's Gym";
      return view('mkt-executive.my-sellers',compact('mysellers','title','cat_id'));
    }
    public function createSellerPost(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
      $this->validate($request,[
         'gym_name' =>'required|min:8',
         'name'=>'required',
         'email'=>'required|email|unique:users,email',
         'phone_no'=>'required|min:10|numeric',
 
         'gym_description' =>'required|min:8',
         'gym_address' => 'required',
         'zip' =>'required|digits:6|integer',
         'city' =>'required',
         'website_link'=>['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
         'category.*'=>'required',
         'gym_licence' => 'required|max:10000|mimes:pdf,jpeg,png,jpg',
          'gym_images.*' => 'required|max:10000|mimes:jpeg,png,jpg',
          'gym_video'   =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:200040',
         'gym_pan'=>'required|max:10000|mimes:pdf,jpeg,png,jpg',
         ]);
          /************** Create USer *****************/
          $exe_id=Auth::user()->id;
        $user= new User;
        $user->email= $request->email;
        $user->phone_no= $request->phone_no;
        $user->name= $request->name;
        $user->password=Hash::make('welcome@1');
        $user->status ='1';
        if($user->save())
        {
          $user_id=$user->id;
          $user->assignRole('seller');
          $gym_licence = $request->file('gym_licence');
          $gym_licencename = time().'-licence-'.$user_id.'.'.$gym_licence->getClientOriginalExtension();
          $file_path = 'licences/';
          $gym_licence->move($file_path, $gym_licencename);

          $gym_pan = $request->file('gym_pan');
          $gym_pan_image = time().'-pan-'.$user_id.'.'.$gym_pan->getClientOriginalExtension();
          $gymspan_path = 'gyms/';
          $gym_pan->move($gymspan_path, $gym_pan_image);

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



          
          $seller = new Seller;
          $seller->user_id = $user_id;
          $seller->gym_name = $request->gym_name;
          $seller->gym_description =$request->gym_description;
          $seller->gym_address =$request->gym_address;
          $seller->zip =$request->zip;
          $seller->city =$request->city;
          $seller->gym_licence =$gym_licencename;
          $seller->gym_images =implode($images, '|');
          $seller->pan_image =$gym_pan_image;
          $seller->website_link =$request->website_link;
          $seller->category_id =implode($request->category, '|');
          $seller->video_link =$video;
          $seller->registered_by ='2';
          $seller->salesexecutive_id =$exe_id;
          $seller->status ='1';
            

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
                $location=$this->seller->getGeocode($address);
              }
              
              $seller_id=$seller->id;
              $gmplocation= new gymLocation;
              $gmplocation->seller_id=$seller_id;
              $gmplocation->lat=$location['lat'];
              $gmplocation->lon=$location['lon'];
              $gmplocation->save();
            }
            $this->admin=new AdminController;
            $this->admin->sendApprovedEmailToSeller($user);
            $message="<b>You have successfully added a seller. Seller is autoapproved you will get an email with your credentials.</b>";
            return redirect()->route('mysellers')->with(['success' => $message]);
            //return redirect()->back()->with(['success' => $message]);
        }

    }
     public function editSellerDetails($seller_id)
    {
      if (Auth::check() && Auth::user()->isSalesExecutive() && isset($seller_id))
      { 
         $exe_id=Auth::user()->id;
          $cities=gymCity::all();
          $categories =gymCategory::all();
          $seller=Seller::where(['id'=>$seller_id,'salesexecutive_id'=>$exe_id])
          ->where('status','!=','2')
          ->with('user','categories')
          ->first();
           $title="Update Seller's Detail";
          if(!$seller)
          {
            $message="You are not authorize to view/edit this seller !!"; 
            return redirect()->route('mysellers')->with(['error' => $message]);
          }
          return view('mkt-executive.edit-seller',compact('seller','cities','categories','seller_id','title'));
      }
      else
      {
        $message="Something went wrong. Please try after sometime !!"; 
        return redirect()->route('mysellers')->with(['error' => $message]);
      }
    }
    public function updateSellerDetailsPost(Request $request,$seller_id)
    {
      if (Auth::check() && Auth::user()->isSalesExecutive() && isset($seller_id))
      {  
        $exe_id=Auth::user()->id;
        $seller_info=Seller::where(['id'=>$seller_id,'salesexecutive_id'=>$exe_id])
          ->where('status','!=','2')
          ->with('user','categories')
          ->first();
        if(!$seller_info)
        {
          $message="You are not authorize to view/edit this seller !!"; 
          return redirect()->route('mysellers')->with(['error' => $message]);
        }
       // echo "<pre>";print_r($seller_info->user_id);die;
        $user_id=$seller_info->user_id;
         $this->validate($request,[
         'gym_name' =>'required|min:8',
         'name'=>'required',
         'email'=>'required|email|unique:users,email,'.$user_id,
         'phone_no'=>'required|min:10|numeric',
 
         'gym_description' =>'required|min:8',
         'gym_address' => 'required',
         'zip' =>'required|digits:6|integer',
         'city' =>'required',
         'website_link'=>['nullable','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
         'category.*'=>'required',
         'gym_licence' => 'max:10000|mimes:pdf,jpeg,png,jpg',
          'gym_images.*' => 'max:10000|mimes:jpeg,png,jpg',
          'gym_video'   =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:200040',
         'gym_pan'=>'max:10000|mimes:pdf,jpeg,png,jpg',
         ]);

         
        $user= user::findOrFail($user_id);
        $user->email= $request->email;
        $user->phone_no= $request->phone_no;
        $user->name= $request->name;
        if($user->save())
        {
          $seller_info->gym_name= $request->gym_name;
          $seller_info->gym_description= $request->gym_description;
          $seller_info->gym_address= $request->gym_address;
          $seller_info->zip= $request->zip;
          $seller_info->city= $request->city;
         // $seller_info->category_id= $request->category;
          $seller_info->category_id =implode($request->category, '|');
          if(isset($request->website_link) && $request->website_link !='')
          {
             $seller_info->website_link= $request->website_link;
          }
          if($request->hasFile('gym_licence'))
          {

            $gym_licence = $request->file('gym_licence');
            $gym_licencename = time().'-licence-'.$user_id.'.'.$gym_licence->getClientOriginalExtension();
            $file_path = 'licences/';
            $gym_licence->move($file_path, $gym_licencename);
            $seller_info->gym_licence= $gym_licencename;
          }
          if($request->hasFile('gym_pan'))
          {
            $gym_pan = $request->file('gym_pan');
            $gym_pan_image = time().'-pan-'.$user_id.'.'.$gym_pan->getClientOriginalExtension();
            $gymspan_path = 'gyms/';
            $gym_pan->move($gymspan_path, $gym_pan_image);
         
            $seller_info->pan_image= $gym_pan_image;
          }
          if($request->hasFile('gym_images'))
          {
            if($files=$request->file('gym_images'))
            {
              $i=1;
              $images=array();
              foreach($files as $file)
              {
                 //echo "<pre>";print_r($file);
                 $filename = time() .'-'.$i. '.' . $file->getClientOriginalExtension();
                  $file->move('gyms/',$filename);
                  $images[]=$filename;
                  $i++;
              }
              $seller_info->gym_images =implode("|",$images);
            }
          }
          if($request->hasFile('gym_images'))
          {   
            $video='';
            if($files=$request->file('gym_video'))
            {
              $filename = time() .'-video'.'.'.$files->getClientOriginalExtension();
              $files->move('gyms/',$filename);
              $video=$filename;
              $seller->video_link =$video;
            }
          }
          if($seller_info->save())
          {
              $location=array();
              if(isset($request->lat) && $request->lat !='' && isset($request->lon) && $request->lon !='')
              {
                $location['lat']=$request->lat;
                $location['lon']=$request->lon;
              }
              else
              {
                $address=$request->gym_address.' '.$request->city.' '.$request->zip;
                $location=$this->seller->getGeocode($address);
              }
              $gymLocation=gymLocation::where('seller_id','=',$seller_info->id)->get();
              //echo $gymLocation[0]->id;die;
              $locations=gymLocation::find($gymLocation[0]->id);
              $locations->lat=$location['lat'];
              $locations->lon=$location['lon'];
              $locations->save();
              $message="<b>You have successfully updated a seller.</b>";
            return redirect()->route('mysellers')->with(['success' => $message]);

          }
        }
      }
      else
      {
        $message="Something went wrong. Please try after sometime !!"; 
        return redirect()->route('mysellers')->with(['error' => $message]);
      }  
    }
  public function deleteSeller(Request $request)
  {
    $arr=array();
    if (Auth::check() && Auth::user()->isSalesExecutive() && isset($request->sellerid))
    { 
      
      $user_id=Auth::user()->id;
      $id=$request->sellerid;
      $Seller= seller::where(['id'=>$id,'salesexecutive_id'=>$user_id])->first();
       
      if($Seller)
      {
          $Seller->status='2';
          $Seller->save();
          $gymPackages=gymPackage::where(['seller_id'=>$id])->get();
          if(count($gymPackages)>0)
          {
            foreach ($gymPackages as $package) 
            {
              $packagedetail=gymPackage::find($package->id);
              $packagedetail->status='2';
              $packagedetail->save();
            }
          }
          
          $arr=array("status"=>"success","message"=>"Your seller and their package has been deleted successfully.");
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
    public function packagesList(Request $request)
    {
      $user_id=Auth::user()->id;
      $filter=['registered_by'=>'2','salesexecutive_id'=>$user_id];
      if(isset($request->seller) && $request->seller !='' && $request->seller !='0')
      {
         $filter['seller_id']=$request->seller;
      }
      $gymPackage=gymPackage::where($filter)
      ->where('status', '!=','2')
      ->with('gymDetail')
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
      ->orderBy('id','DESC')
      ->get();
      $sellers=seller::where(['registered_by'=>'2','salesexecutive_id'=>$user_id])->where('status','!=','2')->get();
      //echo "<pre>";print_r($gymPackage->toArray());die;
      return view('mkt-executive.packages',compact('gymPackage','sellers'));
    }
    public function packagesAdd()
    {
        $user_id=Auth::user()->id;
        //$gym_info = User::find($user_id)->seller;
        $cancellations=membershipCancellation::all();
        $sellers=seller::where(['registered_by'=>'2','salesexecutive_id'=>$user_id])->where('status','!=','2')->get();
        return view('mkt-executive.add-package',compact('sellers','cancellations'));
    }
    public function addPackagePost(Request $request)
    {
        
        $this->validate($request,[
            'seller'=>'required',
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
            $gymPackage= new gymPackage;
            $gymPackage->title= $request->title;
            $gymPackage->seller_id= $request->seller;
            $gymPackage->description= $request->description;
            $gymPackage->cancellation= $request->cancellation;
            $gymPackage->refund= $request->refund;
            $gymPackage->image=  $ms_image;
            $gymPackage->registered_by=  '2';
            $gymPackage->salesexecutive_id=  $user_id;
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
        $packagedetail=gymPackage::where(['id'=>$id,'salesexecutive_id'=>$user_id])
        ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
        ->first();
        $sellers=seller::where(['registered_by'=>'2','salesexecutive_id'=>$user_id])->where('status','!=','2')->get();
        if(!$packagedetail)
        {
           $message="<b>You are not authorize to view/edit this package.";
          return redirect()->route('salesExePackagesList')->with(['success' => $message]);
        }
        $cancellations=membershipCancellation::all();
        //echo "<pre>";print_r($packagedetail->toArray());die;
        return view('mkt-executive.edit-package',compact('packagedetail','cancellations','sellers'));
    }
    public function updatePackage(Request $request, $id)
  {

      $user_id=Auth::user()->id;
      if($user_id == request('salesexecutive_id'))
      {
          $this->validate($request,[
            'seller'=>'required',
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
        $gymPackage->seller_id=$request->seller;
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
            return redirect()->route('salesExePackagesList')->with(['success' => $message]);
        }
        
      }
      else
      {
        $message="You are not authorize to edit this package:";
        return redirect()->back()->with(['error' => $message]);
      }
    
  }
  public function DeletePackage(Request $request)
  {
    $arr=array();
    if (Auth::check() && Auth::user()->isSalesExecutive() && isset($request->package_id))
    { 
      
      $user_id=Auth::user()->id;
      $id=$request->package_id;
      $Seller= gymPackage::where(['id'=>$id,'salesexecutive_id'=>$user_id])->first();
       
      if($Seller)
      {
          $Seller->status='2';
          $Seller->save();
          $arr=array("status"=>"success","message"=>"Your package has been deleted successfully.");
            
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

}

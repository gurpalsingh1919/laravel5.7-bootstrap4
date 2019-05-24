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
use App\storeCategory;
use App\membershipCancellation;
use App\gymMembership;
use App\gymCategory;
use Illuminate\Support\Facades\Auth;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use App\userOrder;
use App\orderPackage;
use App\Textlocal;
use Carbon\Carbon;
use Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;
class TrainerController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function __construct()
    {
      
          $sales='';
          $totalIncome='0';
          //$this->middleware('auth');
        if (Auth::check() && Auth::user()->isFreelancer())
        {
          //$this->middleware(function ($request, $next) {
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
           // return $next($request);
          //});
        }
        $storescategory=storeCategory::where('status','1')->get();
     //echo "<pre>";print_r($sales->toArray());die;
      View::share(['salesArr'=>$sales,'totalIncome'=>$totalIncome,'storeCategory'=>$storescategory]);
    }
    public function trainerwithus()
    {
    	  $cities = gymCity::all();
        return view('trainer.trainer-with-us',compact('cities'));
    }
    public function registerastrainer(Request $request)
    {
      $this->validate($request,[
         'trainer_name'=>'required',
         'trainer_email'=>'required|email|unique:users,email',
         'trainer_address'=>'required|min:10',
         'trainer_zip'=>'required|min:6|numeric',
         'trainer_tel'=>'required|min:10|numeric',
         'trainer_city' =>'required',
         'trainer_Expertize' =>'required',
         
         'trainer_area_expertize' =>'required',
         'trainer_experince' =>'required',
         'gender' =>'required',
         'payment_mode'=>'required',
          ]);

            // $trainer_image = $request->file('trainer_image');
            // $trainer_imagesname = time().'-'.$user_id.'.'.$trainer_image->getClientOriginalExtension();
            // $gymsfile_path = 'images/user/';
            // $trainer_image->move($gymsfile_path, $trainer_imagesname);


            $user= new User;
            $user->name= $request->trainer_name;
            $user->email= $request->trainer_email;
            $user->phone_no= $request->trainer_tel;
           // $user->image= $trainer_imagesname;
            $user->password=Hash::make('welcome@1');
            if($user->save())
            {
                $user->assignRole('freelancer');
                $freelancer=new Seller;
                $user_id=$user->id;
                $freelancer->user_id= $user_id; 
                $freelancer->experience= $request->trainer_experince;
                $freelancer->city= $request->trainer_city;
                $freelancer->expertise= $request->trainer_Expertize;
                $freelancer->payment_mode= $request->payment_mode;
                $freelancer->type_of_expertise= $request->trainer_area_expertize;
                $freelancer->gender= $request->gender;
                $freelancer->gym_address= $request->trainer_address;
                $freelancer->zip= $request->trainer_zip;
                $freelancer->seller_type= '2';
                $freelancer->category_id= '6';
                $freelancer->gym_name= $request->trainer_name;
                if($request->trainer_area_expertize=='Yoga Trainer')
                {
                  $freelancer->category_id= '7';
                }
            
                if($freelancer->save()){
        
                    $message="<b>Thanks for taking interest in Near Gym:</b><br/>
                You have successfully submitted your detail with us. We will check your detail and update you shortly."; 
                        return redirect()->back()->with(['success' => $message]);
                    }
            }
                
        }

    public function trainerlogin()
    {
        return view('trainer.login');
    }
    public function dashboard()
    {
      if (Auth::check() && Auth::user()->isFreelancer())
      {
        $user_id=Auth::user()->id;
        $gym_info = User::find($user_id)->seller;

        $seller_id=$gym_info->id;
        $packages=Seller::find($seller_id)->packages;

        $packages=gymPackage::where('status','!=','2')
        ->where(['seller_id'=>$seller_id])->count();

        $myOrders=userOrder::where(['gym_id'=> $seller_id,'status'=>'1'])
       // ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->get();
        $users=userOrder::where(['gym_id'=> $seller_id,'status'=>'1'])
        ->with('gymdetail','userDetail')
        ->groupBy('user_id')
        ->get();
        return view('trainer.dashboard',compact('gym_info','users','packages','myOrders'));
      }
      else
      {
        $message="Something went wrong. Please try after sometime !!"; 
        return redirect()->back()->with(['error' => $message]);
      }
        
    }
    
    public function packagesList()
    {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $freelancer_id=$gym_info->id;
     // $packages=Seller::find($freelancer_id)->packages;
      $gymPackage=gymPackage::where('status','!=','2')
      ->where(['seller_id'=>$freelancer_id])
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
      ->orderBy('id','DESC')
      ->get();
      //echo "<pre>";print_r($gymPackage->toArray());die;
      return view('trainer.packages',compact('gymPackage','gym_info'));
    }

    public function packagesAdd()
    {
        $user_id=Auth::user()->id;
        $gym_info = User::find($user_id)->seller;
        $cancellations=membershipCancellation::all();
        return view('trainer.add-package',compact('packages_types','gym_info','cancellations'));
    }
    public function deleteMyPackage(Request $request)
  {
    $arr=array();
    if (Auth::check() && Auth::user()->isFreelancer() && isset($request->package_id))
    { 
      
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $freelancer_id=$gym_info->id;
      //echo $freelancer_id.'--'.$request->package_id;die;
      $id=$request->package_id;
      $package= gymPackage::where(['id'=>$id,'seller_id'=>$freelancer_id])->first();
       
      if($package)
      {
          $package->status='2';
          $package->save();
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
        //$packages_types=gymPackageType::all();
        //$packagedetail = gymPackage::where('id',$id)->first();
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
        return view('trainer.edit-package',compact('packagedetail','gym_info','cancellations'));
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
      return view('trainer.my-customers',compact('myOrders','gym_info'));
  }
    public function getmyorder(Request $request)
  {
      
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;
      $filter=['gym_id'=> $gym_id,'status'=>'1'];
      $mycustomers=userOrder::where($filter)
        ->with('userDetail')
        ->groupBy('user_id')
        ->get();
      if(!empty($request->customer) && $request->customer !='0')
      {
        $filter['user_id'] =$request->customer;
      }
      $myOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->get();
      return view('trainer.my-orders',compact('myOrders','gym_info','mycustomers'));
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
      return view('trainer.my-wallet',compact('myOrders','gym_info','totalSale','sellerPendingAmount','mycustomers'));
  }
  public function changepassword()
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;
       return view('trainer.change-password',compact('gym_info'));
  }
  public function generalsettings()
  {
     $user_id=Auth::user()->id;
      $cities = gymCity::all();
     $trainer_info = User::where('id','=',$user_id)->with('seller')->get();
     //echo "<pre>";print_r($trainer_info->toArray());die;
    return view('trainer.general-settings',compact('trainer_info','cities'));
  }
  public function updateGeneralSettings(Request $request,$trainer_id)
  {
     //echo "<pre>";print_r($request->all());die;
          $user_id=Auth::user()->id;
          $this->validate($request,[
         'trainer_name'=>'required',
         'trainer_address'=>'required|min:10',
         'trainer_zip'=>'required|min:6|numeric',
         'trainer_tel'=>'required|min:10|numeric',
         'trainer_city' =>'required',
         'trainer_Expertize' =>'required',
         'trainer_area_expertize' =>'required',
         'trainer_experince' =>'required',
         'gender' =>'required',
         'payment_mode'=>'required',
          ]);

            $user=  User::find($user_id);
            $user->name= $request->trainer_name;
            $user->phone_no= $request->trainer_tel;
            if($user->save())
            {
                $freelancer=Seller::find($trainer_id);
                $freelancer->experience= $request->trainer_experince;
                $freelancer->city= $request->trainer_city;
                $freelancer->expertise= $request->trainer_Expertize;
                $freelancer->payment_mode= $request->payment_mode;
                $freelancer->type_of_expertise= $request->trainer_area_expertize;
                $freelancer->gender= $request->gender;
                $freelancer->gym_address= $request->trainer_address;
                $freelancer->zip= $request->trainer_zip;
               
                if($freelancer->save())
                {
        
                    $message="<b>You have successfully updated your detail."; 
                    return redirect()->back()->with(['success' => $message]);
                }
            }
  }
  public function trainer(){

      return view('trainer.index');
  }
  public function trainerListing(){
    
      return view('trainer.trainerlisting');
  }
  public function getNutrition()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $gym_id=$gym_info->id;
    $mynutritions=assignNutrition::where(['assigne_id'=> $gym_id,'status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")
    ->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('trainer.nutrition',compact('mynutritions'));
  }
  public function assignNutrition(Request $request)
  {
      $user_id=Auth::user()->id;
      $gym_info = User::find($user_id)->seller;
      $gym_id=$gym_info->id;

      // $mycustomers=userOrder::where(['gym_id'=> $gym_id,'status'=>'1'])
      //   ->with('gymdetail','userDetail')
      //   ->groupBy('user_id')
      //   ->get();

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
      //echo "<pre>";
      //print_r($mycustomers->toArray());
      //print_r($mycustomers->toArray());
      //die;
      return view('trainer.nutritionassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function deleteNutrition(Request $request)
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
  public function assignNutritionToUser(Request $request)
  {
      $this->validate($request,[
            'customer'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'week_days' => 'required',
            'nutrition' => 'required',
            //'video'=>'required',
         ]);
      
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
        
  }
  public function getWorkouts(Request $request)
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $gym_id=$gym_info->id;
    $myworkouts=assignWorkout::where(['assigne_id'=> $gym_id,'status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")
    ->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('trainer.workoutlog',compact('myworkouts'));
  }
  public function assignWorkout(Request $request)
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
      return view('trainer.workoutassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function assignWorkoutToUser(Request $request)
  {
    $this->validate($request,[
            'customer'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'week_days' => 'required',
            'workout' => 'required',
            'description'=>'required',
            //'video'=>'required'
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
  public function deleteWorkouts(Request $request)
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
  public function getAttendance(Request $request)
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
  }
  public function checkattendance(Request $request)
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
    return view('trainer.attendance',compact('packages','mycustomers','present','freelancer_id','package_id','pack_name','formatted_date'));
  }
  public function SubmitUserAttandance(Request $request)
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
  public function addNewProduct()
  {
    $productCategory=productCategory::all();
    return view('trainer.add-product',compact('productCategory'));
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
        return view('trainer.edit-product',compact('productDetail','productCategory','product_id'));
      }
      else
      {
        redirect()
        ->route('getAllProductList')
        ->with('success','You are not authorize to update this product.');
      }
      
    }
    else
    {
        redirect()
        ->route('getAllProductList')
        ->with('success','Something missing please try after sometime.');
    }
   
  }
  public function deleteProduct(Request $request)
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
  public function getAllProductList()
  {
    $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    $gymProduct=gymProduct::where(['seller_id'=>$seller_id])
    ->where('status','!=','3')
    ->get();
    return view('trainer.my-products',compact('gymProduct'));
  }
  public function getMyStore(Request $request)
  {

     $user_id=Auth::user()->id;
    $gym_info = User::find($user_id)->seller;
    $seller_id=$gym_info->id;
    $business_detail=Seller::find($seller_id);
    return view('trainer.my-store',compact('business_detail'));
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

    //$user_id=Auth::user()->id;
    //$gym_info = User::find($user_id)->seller;
    //$seller_id=$gym_info->id;
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

      return view('trainer.addNewProduct');

  }
  public function OtpVerifyOnPhone(Request $request)
  {
    $this->validate($request,[
      'contact_no'=>'required',
    ]);
   


    $textlocal=new Textlocal('gurpal.singh1919@gmail.com','HvvRs78peCo-20Dsrz9gbfi8Jd2ftbWiR4rBuIDyep');
    $textlocal->sendSms($request->contact_no,'Your car - KA01 HG 9999 - is due for service on July 24th, please text SERVICE to 92205 92205 for a callback','FORDIN');
     echo "<pre>";print_r($request->all());die;
  }


}
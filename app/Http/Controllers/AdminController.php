<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Seller;
use App\User;
use App\assignNutrition;
use App\productCategory;
use App\gymProduct;
use App\assignWorkout;
use App\attendance;
use App\gymLocation;
use App\gymPackage;
use App\gymPackageType;
use App\membershipCancellation;
use App\gymMembership;
use App\gymCity;
use App\gymCategory;
use App\gymFacility;
use DB;
use Hash;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use App\userOrder;
use App\orderPackage;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\setting;
use App\promotion;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\View;
use Response;
class AdminController extends Controller
{
  public function __construct()
  {
    $cities=gymCity::all();
    $gymCategory=gymCategory::all();

    $Seller=Seller::all();
    $gymPackageType=gymPackageType::all();
    //$User=User::all()->roles()->where('name', 'user')->get();
    $roleName='user';
    $User=User::whereHas('roles', function ($q) use ($roleName) {
    $q->where('name', $roleName);
    })->get();
    $productCategory=productCategory::all();
    $sales=userOrder::where('status','=','1')
    ->select(DB::raw('sum(net_payment) as `sales`')
      ,DB::raw('sum(admin_comission) as `admin_comission`')
      ,DB::raw('sum(maintence_charges) as `maintence_charges`')
      ,DB::raw('sum(tax) as `tax`')
      ,DB::raw('sum(service_charges) as `service_charges`')
      ,DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
      ->groupby('year','month')
      ->get();

      
     
    //echo "<pre>";print_r($sales->toArray());die;
    $gymPackage=gymPackage::all();
    View::share(['cities'=>$cities,'gymCategory'=>$gymCategory,'Sellers'=>$Seller,'gymPackageType'=>$gymPackageType,'users'=>$User,'gymPackage'=>$gymPackage,'salesArr'=>$sales,'productCategory'=>$productCategory]);
    $this->seller=new SellerController;
  }
	public function login()
	{
		return view('admins.login');
	}
    public function dashboard()
    {
      $sellers=Seller::where('seller_type','=','1')->count();
      $trainers=Seller::where('seller_type','=','2')->count();
      $User=User::count();
      $gymPackage=gymPackage::count();
      $orders=userOrder::count();
      $gymCity=gymCity::count();
      $gymCategory=gymCategory::count();
    	return view('admins.dashboard',compact('sellers','gymPackage','User','orders','gymCity','gymCategory','trainers'));
    }
    public function getallusers()
    {
    	$roleName='user';
      $User=User::whereHas('roles', function ($q) use ($roleName) {
      $q->where('name', $roleName);
      })->get();
    	//echo "<pre>";print_r($users->toArray());die;
    	return view('admins.users',compact('users'));
    }
    public function adminChangePassword()
  	{
      return view('admins.change-password',compact('gym_info'));
  	}
  	public function getAllSellers(Request $request)
  	{
       $filter=['seller_type'=>'1'];
      if(!empty($request->city) && $request->city !='0')
      {
        $filter['city'] =$request->city;
       }
       $cat_id='0';
      if(!empty($request->category) && $request->category !='0')
      {
        //$filter['category_id'] =$request->category;
        $cat_id=$request->category;
      }

     // $filter=['seller_type'=>'1','city'=>$city,'category_id'=>$category];
      //echo "<pre>";print_r($filter);die;
  		$sellers=Seller::where($filter)->with('user')->get();
      //echo "<pre>";print_r($cat_id);die;
      $title="All Seller's Gym";
  		return view('admins.all-sellers',compact('sellers','title','cat_id'));
  	}
    
    public function approvedSeller(Request $request)
    {
       $filter=['status'=>'1','seller_type'=>'1'];
       if(!empty($request->city) && $request->city !='0')
      {
        $filter['city'] =$request->city;
       }
       $cat_id='0';
      if(!empty($request->category) && $request->category !='0')
      {
        //$filter['category_id'] =$request->category;
        $cat_id=$request->category;
      }

        $sellers=Seller::where($filter)->with('user')->get();
         $title="Approved Seller's Gym";
        return view('admins.all-sellers',compact('sellers','title','cat_id'));
    }
    public function UnapprovedSeller(Request $request)
    {
      $filter=['status'=>'0','seller_type'=>'1'];
       if(!empty($request->city) && $request->city !='0')
      {
        $filter['city'] =$request->city;
       }
       $cat_id='0';
      if(!empty($request->category) && $request->category !='0')
      {
        //$filter['category_id'] =$request->category;
        $cat_id=$request->category;
      }
        $sellers=Seller::where($filter)->with('user')->get();
         $title="Approval Pending Seller's Gym";
        return view('admins.all-sellers',compact('sellers','title','cat_id'));
    }
    public function getAllTrainers()
    {
      $trainers=Seller::where('seller_type','=','2')->with('user')->get();
      $title="All Seller's Gym";
      return view('admins.all-trainers',compact('trainers','title'));
    }
     public function approvedTrainers()
    {
        $trainers=Seller::where(['status'=>'1','seller_type'=>'2'])->with('user')->get();
         $title="Approved Seller's Gym";
        return view('admins.all-trainers',compact('trainers','title'));
    }
    public function UnapprovedTrainers()
    {
        $trainers=Seller::where(['status'=>'0','seller_type'=>'2'])->with('user')->get();
         $title="Approval Pending Seller's Gym";
        return view('admins.all-trainers',compact('trainers','title'));
    }
    public function getAllPackages(Request $request)
    {
      $filter=array();
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      
       $gymPackages=gymPackage::where($filter)
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])->orderBy('gym_packages.id', 'DESC')->get();
      $title="All Gym's Packages";
     //echo "<pre>";print_r($gymPackages->toArray());die;
      return view('admins.all-packages',compact('gymPackages','title'));
    }
    public function getApprovePackages(Request $request)
    {
      $filter=['status'=>'1'];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      
       $gymPackages=gymPackage::where($filter)
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])->orderBy('gym_packages.id', 'DESC')->get();
      $title="Approved Packages";
      //echo "<pre>";print_r($gymPackages->toArray());die;
      return view('admins.all-packages',compact('gymPackages','title'));
    }
    public function getUnapprovePackages(Request $request)
    {
      $filter=['status'=>'0'];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      
       $gymPackages=gymPackage::where($filter)
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])->orderBy('gym_packages.id', 'DESC')->get();
      $title="Approval Pending Packages";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-packages',compact('gymPackages','title'));
    }

    public function getAllStores(Request $request)
    {
      $allStores=Seller::where('store_status','!=','2' )
        ->orderBy('id', 'DESC')
        ->get();
      $title="All Stores";
      return view('admins.all-stores',compact('allStores','title'));
    }
     public function getApprovedStores(Request $request)
    {
      $allStores=Seller::where('store_status','=','1' )
        ->orderBy('id', 'DESC')
        ->get();
      $title="Approved Stores";
      //echo "<pre>";print_r($gymPackages->toArray());die;
      return view('admins.all-stores',compact('allStores','title'));
    }
    public function getUnapprovedStores(Request $request)
    {
      $allStores=Seller::where('store_status','=','3' )
        ->orderBy('id', 'DESC')
        ->get();
      $title="Approval Pending Stores";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-stores',compact('allStores','title'));
    }
    public function getStoreDetail(Request $request,$store_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        if(isset($store_id))
        {
          $storeDetail=Seller::where(['id'=>$store_id])->where('store_status','!=','2' )->first();
          return view('admins.store',compact('storeDetail'));
        }
        else
        {
          redirect()
          ->route('getAllStores')
          ->with('success','Store detail not available.');
        }
       
      }
    }
    public function changeStoreStatus(Request $request)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        $input=$request->update_status;
        $id=$request->id;
        $store= Seller::find($id);
        $store->store_status=$input;
        if($store->save())
        {
             $arr=array("status"=>"success","message"=>"You have sucessfully changed store status !!!");
        }
        else
        {
           $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
        }
      }
      else
      {
        $arr=array("status"=>"error","message"=>"You are not authorize to make this action !!");
      }
      return  Response::json( $arr );
       
    }

     public function getAllProducts(Request $request)
    {
      $filter=array();
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      $allproducts=gymProduct::where($filter)
        ->with('gymDetail','productCategories')
        ->orderBy('id', 'DESC')
        ->get();
      $title="All Products";

      return view('admins.all-products',compact('allproducts','title'));
    }
     public function getApprovedProducts(Request $request)
    {
      $filter=array();
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      $filter['status'] ='1';
      $allproducts=gymProduct::where($filter)
        ->with('gymDetail','productCategories')
        ->orderBy('id', 'DESC')
        ->get();
      $title="Approved Products";
      //echo "<pre>";print_r($gymPackages->toArray());die;
      return view('admins.all-products',compact('allproducts','title'));
    }
    public function getUnapprovedProducts(Request $request)
    {
      $filter=array();
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['seller_id'] =$request->seller;
      }
      $filter['status'] ='0';
      $allproducts=gymProduct::where($filter)
        ->with('gymDetail','productCategories')
        ->orderBy('id', 'DESC')
        ->get();
      $title="Approval Pending Products";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-products',compact('allproducts','title'));
    }
    public function getProductDetail($product_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
         $gymProduct=gymProduct::where(['id'=>$product_id])
         ->with('gymDetail','productCategories')
         ->first();
        return view('admins.product',compact('gymProduct'));
      }
    }
    public function editProductDetails($product_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        $gymProduct=gymProduct::where(['id'=>$product_id])
         ->with('gymDetail','productCategories')
         ->first();
        return view('admins.edit-product',compact('gymProduct','product_id'));
      }
    }
    public function updateProductDetailsPost(Request $request,$product_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        //echo "<pre>";print_r($request->all());die;
        $this->validate($request,[
        'product_images.*'=>'max:10000|mimes:jpeg,png,jpg',
        'product_name'=>'required',
        'product_description'=>'required|min:10',
        'product_category'=>'required',
        'product_color'=>'required',
        'product_size'=>'required',
        'product_price'=>'required',
        'admin_comission'=>'required',
        // 'available_quantity'=>'required',
        
     ]);
        if(isset($product_id))
        {
          $productDetail=gymProduct::where(['id'=>$product_id])->first();
          if($productDetail)
          {
              $productDetail->seller_id=$request->seller;
              $productDetail->name=$request->product_name;
              $productDetail->description=$request->product_description;
              $productDetail->category=$request->product_category;
              $productDetail->colors=json_encode($request->product_color);
              $productDetail->size=json_encode($request->product_size);
              $productDetail->price=$request->product_price;
              $productDetail->discount=$request->discount;
              $productDetail->weight=$request->weight;
              $productDetail->admin_comission=$request->admin_comission;
              //$productDetail->status='1';
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
                $message="<b>You have successfully updated a product detail.</b>";
                  return redirect()->back()->with(['success' => $message]);
              }
           
          }
          else
          {
            redirect()
            ->route('getAllProducts')
            ->with('success','You are not authorize to update this product.');
          }
          
        }
        else
        {
            redirect()
            ->route('getAllProducts')
            ->with('success','Something missing please try after sometime.');
        }
      }
    }
    public function addProductByAdmin()
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
       
        return view('admins.add-product');
      }
    }
    public function addProductByAdminPost(Request $request)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
          //echo "<pre>";print_r($request->all());die;
          $this->validate($request,[
          'seller'=>'required',
          'product_name'=>'required',
          'product_description'=>'required|min:10',
          'product_category'=>'required',
          'product_color'=>'required',
          'product_size'=>'required',
          'product_price'=>'required',
          'admin_comission'=>'required',
          'product_images'=>'required',
          'product_images.*'=>'max:10000|mimes:jpeg,png,jpg',
          // 'available_quantity'=>'required',
          ]);
          $productDetail=new gymProduct();
          $productDetail->seller_id=$request->seller;
          $productDetail->name=$request->product_name;
          $productDetail->description=$request->product_description;
          $productDetail->category=$request->product_category;
          $productDetail->colors=json_encode($request->product_color);
          $productDetail->size=json_encode($request->product_size);
          $productDetail->price=$request->product_price;
          $productDetail->discount=$request->discount;
          $productDetail->weight=$request->weight;
          $productDetail->admin_comission=$request->admin_comission;
          $productDetail->status='1';
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
            $message="<b>You have successfully added a product detail.</b>";
              return redirect()->back()->with(['success' => $message]);
          }
       }
       else
       {
          redirect()
            ->route('getAllProducts')
            ->with('success','Something missing please try after sometime.');
       }
    }
    public function changeProductStatus(Request $request)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        $input=$request->update_status;
        $id=$request->id;
        $product= gymProduct::find($id);
        $product->status=$input;
        if($product->save())
        {
             $arr=array("status"=>"success","message"=>"You have sucessfully changed product status !!!");
        }
        else
        {
           $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
        }
      }
      else
      {
        $arr=array("status"=>"error","message"=>"You are not authorize to make this action !!");
      }
      return  Response::json( $arr );
       
    }

    public function getSellerDetails($seller_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        $categories =gymCategory::all();
        $seller=Seller::where('id','=',$seller_id)
        ->with('user','categories')
        ->get();
        //echo "<pre>";print_r($categories->toArray());die;
        return view('admins.seller',compact('seller','categories'));
      }
    }
    public function editSellerDetails($seller_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
          $cities=gymCity::all();
          $categories =gymCategory::all();
          $seller=Seller::where('id','=',$seller_id)
          ->with('user','categories')
          ->get();
          return view('admins.edit-seller',compact('seller','cities','categories','seller_id'));
      }
    }

    public function changeSellerStatus(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
      $input=$request->update_status;
      $id=$request->id;
      $Seller= Seller::find($id);
      $Seller->status=$input;
      if($Seller->save())
      {
        $location=Seller::find($id)->locations;
        $location->status=$input;
        if($location->save())
        {
             $user_id=$Seller->user_id;
             $user=User::find($user_id);
             $user->status='1';
             $user->save();
            $this->sendApprovedEmailToSeller($user);
        }


      }
    }
    public function DeactivateSeller(Request $request)
    {
      $input=$request->update_status;
      $id=$request->id;
      $Seller= Seller::find($id);
      $Seller->status=$input;
      if($Seller->save())
      {
        $location=Seller::find($id)->locations;
        $location->status=$input;
        $location->save();
      }
       
    }
    public function updateTrainerStatus(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
      $input=$request->update_status;
      $id=$request->id;
      $Seller= Seller::find($id);
      $Seller->status=$input;
      if($Seller->save())
      {
            $user_id=$Seller->user_id;
            $user=User::find($user_id);
            $user->status='1';
            if($user->save())
            {
              $message="Approved Successfully";
              $result=['message' => $message];
              return $result;
            }
            $password='welcome@1';
            $this->sendTrainerApprovalEmail($user,$password);
      }
    }
    public function sendApprovedEmailToSeller($user)
    {
     //$user_id=$Seller->user_id;
      //echo $user_id;die;
      //$user=User::find($user_id);
      Mail::send('email.approve-seller', [
        'user'=>$user
      ], function($message) use ($user) {
          $message->to($user->email,'Near Gym');
          $message->subject("Hello $user->name, Welcome to the Near Gym !!! Your Gym has been Approved Now you can add your packages.");
        });

    }
    public function settings()
    {
      $setting=setting::all();
      return view('admins.setting',compact('setting'));
    }
    public function updateGymSettingPost(Request $request)
    {
      $this->validate($request,[
            // 'admin_comission'=>'required',
            'maintenance_charges'=>'required',
            'tax_percentage'=>'required',
            'services_charges'=>'required',
          ]);

      $setting=setting::find(1);
      //$setting->admin_comission=$request->admin_comission;
      $setting->maintenance_charges=$request->maintenance_charges;
      $setting->tax_percentage=$request->tax_percentage;
      $setting->services_charges=$request->services_charges;
      if($setting->save())
      {
        $message="<b>You have successfully updated gym settings.</b>";
        return redirect()->back()->with(['success' => $message]);
      }

      
    }
    public function getPackageDetail($pack_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
         $gymPackage=gymPackage::where(['id'=>$pack_id])
         ->with('gymDetail')
         ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
         ->orderBy('id','DESC')
         ->first();
        return view('admins.package',compact('gymPackage'));
      }
    }
    public function editPackageDetails($pack_id)
    {
      if (Auth::check() && Auth::user()->isAdministrator())
      {
        //$gymPackage=gymPackage::where('id','=',$pack_id)->with('gymDetail','pack_categories')->get();
         $packagedetail=gymPackage::where(['id'=>$pack_id])
         ->with('gymDetail')
         ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
         ->orderBy('id','DESC')
         ->first();
          $cancellations=membershipCancellation::all();
           $sellers=seller::where(['status'=>'1'])
      ->get();
          //echo "<pre>";print_r($packagedetail->toArray());die;
          return view('admins.edit-package',compact('packagedetail','pack_id','cancellations','sellers'));
      }
    }
  public function updatePackageDetailsPost(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->isAdministrator())
    {
      if($id)
      {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required|min:8',
            'memberships'=>'required',
            //'membership_image'=>'required| max:10485760|mimes:jpeg,png,jpg',
            'cancellation' => 'required',
            'refund' => 'required',
            'seller'=>'required',
            'admin_comission'=>'required|numeric',
             
         ]);

        $gymPackage = gymPackage::find($id);
        $gymPackage->title= $request->title;
        $gymPackage->description= $request->description;
        $gymPackage->cancellation=$request->cancellation;
        $gymPackage->refund=$request->refund;
        $gymPackage->seller_id=$request->seller;  
        $gymPackage->admin_comission=$request->admin_comission;
        $gymPackage->status='1';
        $ms_image='';
        if($request->hasFile('membership_image'))
        {
          $file=$request->file('membership_image');
          $ms_image = time() .'-'.rand(1, 1000000). '.' .$file->getClientOriginalExtension();
          $file->move('package/',$ms_image);
          $gymPackage->image=$ms_image;
        
        }
       // echo "<pre>";print_r($request->all());die;
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
    
  }
  public function AddPackageByAdministrator()
  {
    if (Auth::check() && Auth::user()->isAdministrator())
    {
      // $packages_types=gymPackageType::all();
      $sellers=seller::where(['status'=>'1'])
      ->get();
      //return view('admins.add-package',compact('packages_types','sellers'));
      //$user_id=Auth::user()->id;
      $cancellations=membershipCancellation::all();
      return view('admins.add-package',compact('packages_types','cancellations','sellers'));
    }
  }
  public function addnewPackagePost(Request $request)
  {
     if (Auth::check() && Auth::user()->isAdministrator())
    {
       
        $this->validate($request,[
            'seller'=>'required',
            'admin_comission'=>'required|numeric',
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
            $gymPackage= new gymPackage;
            $gymPackage->title= $request->title;
            $gymPackage->seller_id= $request->seller;
            $gymPackage->admin_comission= $request->admin_comission;
            //$gymPackage->seller_id= $seller_id;
            $gymPackage->description= $request->description;
            $gymPackage->cancellation= $request->cancellation;
            $gymPackage->refund= $request->refund;
            $gymPackage->image=  $ms_image;
            $gymPackage->status= '1';
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
                This package is auto approved you can check.";
                return redirect()->back()->with(['success' => $message]);

            }



    }
  }

    public function changePackageStatus(Request $request)
    {
      $arr=array();
      if (Auth::check() && Auth::user()->isAdministrator() && isset($request->id))
      { //echo "<pre>";print_r($request->all());die;
        /*$input=$request->update_status;
        $id=$request->id;
        $Seller= gymPackage::find($id);
        $Seller->status=$input;
        if($Seller->save())
        {
          $location=Seller::find($id)->locations;
          $location->status=$input;
          $location->save();
        }*/

        if($request->id)
          {
            $input=$request->update_status;
            $id=$request->id;
            $Seller= gymPackage::find($id);
            $Seller->status=$input;
            if($Seller->save())
            {
                // $location=Seller::find($id)->locations;
                // $location->status=$input;
                // $location->save();
                $arr=array("status"=>"success","message"=>"Package status has been updated successfully.");
                
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
         


      }
      else
      {
         $arr=array("status"=>"error","message"=>"Something went wrong. Please try after sometime !!");
      }
       //echo "<pre>";print_r($arr);die;
       return  Response::json( $arr );
    }
    public function getAllPayment(Request $request)
    {
      $filter=['status'=>'1'];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['gym_id'] =$request->seller;
      }
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
      
      $allOrders=userOrder::where($filter)
      ->with('gymdetail','orderDetail.packageDetails','userDetail')
      ->orderBy('id','DESC')
      ->get();
       $totalSale=userOrder::where($filter)->sum('net_payment');
       $sellerAmount=userOrder::where($filter)->sum('seller_amount');
       $admin_comission=userOrder::where($filter)->sum('admin_comission');
       $tax=userOrder::where($filter)->sum('tax');
       $maintenance_charges=userOrder::where($filter)->sum('maintence_charges');
       $services_charges=userOrder::where($filter)->sum('service_charges');
       $adminAmount=$admin_comission+$tax+$maintenance_charges+$services_charges;


       //echo $adminAmount;die;
      $title="All Payment";

      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-payment',compact('allOrders','totalSale','sellerAmount','title','adminAmount'));
    }
    public function getAllOrders(Request $request)
    {
       $filter=[];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['gym_id'] =$request->seller;
      }
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
      $allOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->orderBy('id','DESC')
        ->get();

      $title="All Orders";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-orders',compact('allOrders','title'));
    }
    public function getCompletedOrder()
    {
       $filter=['status'=>'1'];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['gym_id'] =$request->seller;
      }
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


        $allOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->orderBy('id','DESC')
        ->get();
      $title="All Orders";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-orders',compact('allOrders','title'));
    }
    public function getFailedOrder()
    {
      $filter=[];
      $filter[]=['status','!=','1'];
      if(!empty($request->seller) && $request->seller !='0')
      {
        $filter['gym_id'] =$request->seller;
      }
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
        $allOrders=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->orderBy('id','DESC')
        ->get();
      $title="All Orders";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-orders',compact('allOrders','title'));
    }
    public function getAllpromotions()
    {

      $promotion=promotion::all();
      $title="All Promotion and offers";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-promotions',compact('promotion','title'));
    }
    public function addnewPromotion()
    {
      return view('admins.add-promotion');
    }
    public function addnewPromotionPost(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
            'image'=>'required| max:10000|mimes:jpeg,png,jpg',
            
          ]);
         $images='';
        if($file=$request->file('image'))
        {
          $filename = time() .'-promotion'.'.'. $file->getClientOriginalExtension();
          $file->move('promotion/',$filename);
          $images=$filename;
          
        }
      $promotion=new promotion;
      $promotion->name=$request->name;
      $promotion->image=$images;
      if($promotion->save())
      {
        $message="<b>You have successfully submitted new promotion.</b>";
        return redirect()->back()->with(['success' => $message]);
      }
    }
    public function deletePromotion($id)
    {
      $promotion = promotion::findOrFail($id);
      $promotion->delete();
      $message="<b>You have successfully deleted a promotion.</b>";
      return redirect()->back()->with(['success' => $message]);
    }
    public function updatePromotion($promo_id)
    {
      $promotion = promotion::findOrFail($promo_id);
      return view('admins.update-promotion',compact('promotion','promo_id'));
    }
    public function updatePromotionpost(Request $request, $id)
    {
        $promotion = promotion::findOrFail($id);
           $this->validate($request, [
        'name' => 'required',
        'image' => 'max:10000|mimes:jpeg,png,jpg',
          ]);

          
          $images='';
          if($request->file('image') !==NULL && !empty($request->file('image')))
          {
            $file=$request->file('image');
            $filename = time() .'-promotion'.'.'. $file->getClientOriginalExtension();
            $file->move('promotion/',$filename);
            $images=$filename;

            $promotion->image=$images;
            
          }

          $promotion->name=$request->name;
          
          if($promotion->save())
          {
            $message="<b>You have successfully updated promotion.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }


    public function getAllCities()
    {

      $gymCity=gymCity::all();
      $title="All available Cities";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-cities',compact('gymCity','title'));
    }
    public function addnewcity()
    {
      return view('admins.add-city');
    }
    public function addnewcityPost(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            
          ]);
         
      $gymCity=new gymCity;
      $gymCity->name=$request->name;
      $gymCity->lat=$request->latitude;
      $gymCity->lon=$request->longitude;
      if($gymCity->save())
      {
        $message="<b>You have successfully submitted new city.</b>";
        return redirect()->back()->with(['success' => $message]);
      }
    }
    public function deleteCity($id)
    {
      $gymCity = gymCity::findOrFail($id);
      $gymCity->delete();
      $message="<b>You have successfully deleted a City.</b>";
      return redirect()->back()->with(['success' => $message]);
    }
    public function updateCity($city_id)
    {
      $gymCity = gymCity::findOrFail($city_id);
      return view('admins.update-city',compact('gymCity','city_id'));
    }
     public function updateCitypost(Request $request, $id)
    {
        $gymCity = gymCity::findOrFail($id);
           $this->validate($request, [
        'name' => 'required',
         'latitude'=>'required',
            'longitude'=>'required',
          ]);

         

          $gymCity->name=$request->name;
          $gymCity->lat=$request->latitude;
          $gymCity->lon=$request->longitude;
          if($gymCity->save())
          {
            $message="<b>You have successfully updated city.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }
    public function getAllGymCategories()
    {

      $gymCategory=gymCategory::all();
      $title="All available Gym Categories";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-categories',compact('gymCategory','title'));
    }
    public function addnewcategory()
    {
      return view('admins.add-category');
    }
    
    public function addnewcategoryPost(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
            ]);
         
          $gymCategory=new gymCategory;
          $gymCategory->name=$request->name;
          if($gymCategory->save())
          {
            $message="<b>You have successfully submitted new Category.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }
    public function deleteCategory($id)
    {
      $gymCategory = gymCategory::findOrFail($id);
      $gymCategory->delete();
      $message="<b>You have successfully deleted a Category.</b>";
      return redirect()->back()->with(['success' => $message]);
    }
    public function updateCategory($cat_id)
    {
      $gymCategory = gymCategory::findOrFail($cat_id);
      return view('admins.update-category',compact('gymCategory','cat_id'));
    }
     public function updateCategorypost(Request $request, $id)
    {
        $gymCategory = gymCategory::findOrFail($id);
           $this->validate($request, [
        'name' => 'required',
         ]);

         

          $gymCategory->name=$request->name;
         if($gymCategory->save())
          {
            $message="<b>You have successfully updated Category.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }

    /************** Add Facility ****************/
    public function getAllGymfacilities()
    {

      $gymFacility=gymFacility::all();
      $title="All Available Gym Facilities";
      //echo "<pre>";print_r($gymPackages);die;
      return view('admins.all-facilities',compact('gymFacility','title'));
    }
    public function addnewfacilities()
    {
      return view('admins.add-facility');
    }
     public function addfacilityPost(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
            ]);
         
          $gymFacility=new gymFacility;
          $gymFacility->name=$request->name;
          if($gymFacility->save())
          {
            $message="<b>You have successfully submitted new gym facility.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }
     public function deleteFacility($id)
    {
      $gymFacility = gymFacility::findOrFail($id);
      $gymFacility->delete();
      $message="<b>You have successfully deleted a Facility.</b>";
      return redirect()->back()->with(['success' => $message]);
    }
    
    public function updateFacility($facility_id)
    {
      $gymFacility = gymFacility::findOrFail($facility_id);
      return view('admins.update-facility',compact('gymFacility','facility_id'));
    }
     public function updateFacilitypost(Request $request, $facility_id)
    {
        $gymFacility = gymFacility::findOrFail($facility_id);
           $this->validate($request, [
        'name' => 'required',
         ]);

         

          $gymFacility->name=$request->name;
         if($gymFacility->save())
          {
            $message="<b>You have successfully updated Facility.</b>";
            return redirect()->back()->with(['success' => $message]);
          }
    }




    public function addSellerByAdmin()
    {
      $cities=gymCity::all();
       $categories=gymCategory::all();
       return view('admins.add-seller',compact('cities','categories'));
    }
    public function addSellerByAdminPost(Request $request)
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
          $seller->registered_by ='1';
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
            $this->sendApprovedEmailToSeller($user);
            $message="<b>You have successfully added a seller. Seller is autoapproved you will get an email with your credentials.</b>";
            return redirect()->back()->with(['success' => $message]);
        }

    }
    public function updateSellerDetailsPost(Request $request,$id)
    {
       
       // $seller_info = User::find($id)->seller;
        $seller_info =Seller::find($id);
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
            return redirect()->back()->with(['success' => $message]);

          }
         //echo "<pre>";print_r($seller_info);die;
        }
        

        
    }
    public function orderSummary($order_id)
    {
      $filter=['id'=>$order_id];
       $orderdetail=userOrder::where($filter)
        ->with('gymdetail','orderDetail.packageDetails','userDetail')
        ->orderBy('id','DESC')
        ->get();
       // echo "<pre>";print_r($orderdetail->toArray());die;
        return view('admins.ordersummary',compact('orderdetail'));

    }
    public function addMarketingExecutive()
  {
    if (Auth::check() && Auth::user()->isAdministrator())
    {
      return view('admins.marketing-executive');
    }
  }
  public function addMarketingExecutivePost(Request $request)
  {
     if (Auth::check() && Auth::user()->isAdministrator())
    {
      $this->validate($request, [
            //'name' => 'required',
            'phone_no'=>'required|regex:/[0-9]{10}/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['name']=$request->first_name.' '.$request->last_name;
        $input['status'] ='1';
        $input['roles'] ='11';
        

        $user = User::create($input);
        $user->assignRole('11');
        $this->sendRegisterEmailToMarketingExecutive($user,$request->password);
        $message="<b>Congratulation !!! You are successfully registed a Marketing Executive.</b>";
        return redirect()->back()->with(['success' => $message]);
      

      }
  }
 
  public function allMarketingExecutive()
  {
    $roleName='salesexecutive';
     $marketingExecutives=User::whereHas('roles', function ($q) use ($roleName) {
    $q->where('name', $roleName);
    })->get();

      return view('admins.all-marketing-exe',compact('marketingExecutives'));
  }
  public function updateMarketingExecutive($mktexecutive_id)
  {
    
    $roleName='salesexecutive';
     $marketingExecutivesDetail=User::where('id','=',$mktexecutive_id)->whereHas('roles', function ($q) use ($roleName) {
    $q->where('name', $roleName);
    })->get();
    return view('admins.update-mkt-executive',compact('marketingExecutivesDetail','mktexecutive_id'));
  }
  public function updateMarketingExecutivePost(Request $request,$mktexecutive_id)
  {
    $this->validate($request, [
            //'name' => 'required',
            'phone_no'=>'required|regex:/[0-9]{10}/',
            'email' => 'required|email|unique:users,email,'.$mktexecutive_id,
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required'
        ]);
    $input = $request->all();
    $input['name']=$request->first_name.' '.$request->last_name;
    $user=User::find($mktexecutive_id);
   if($user->update($input))
    {
     $message="<b>Congratulation !!! You have successfully updated a Marketing Executive.</b>";
        return redirect()->back()->with(['success' => $message]);
    }
  }
  public function sendRegisterEmailToMarketingExecutive($user,$pass)
  {
   //$user_id=$Seller->user_id;
    //echo $user_id;die;
    //$user=User::find($user_id);
    Mail::send('email.register-marketing-executive', [
      'user'=>$user,
      'password'=>$pass
    ], function($message) use ($user) {
        $message->to($user->email,'Near Gym');
        $message->subject("Hello $user->name, Welcome to the Near Gym");
      });

  }
  public function getTrainerDetail(Request $request,$trainer_id)
  {
    $cities = gymCity::all();
    //$trainer_info = User::where('id','=',$trainer_id)->with('seller')->get();
    $trainer_info=seller::where('id','=',$trainer_id)->with('user')->get();
    //echo "<pre>";print_r($trainer_info->toArray());die;
     return view('admins.update-trainer',compact('trainer_id','trainer_info','cities'));
  }
  public function updateTrainerPost(Request $request,$trainer_id)
  {
       $this->validate($request,[
         'trainer_name'=>'required',
         //'trainer_email'=>'required|email|unique:users,email',
         'trainer_address'=>'required|min:10',
         'trainer_zip'=>'required|min:6|numeric',
         'trainer_tel'=>'required|min:10|numeric',
         'trainer_city' =>'required',
         'trainer_expertize' =>'required',
         
         'trainer_area_expertize' =>'required',
         'trainer_experince' =>'required',
         'gender' =>'required',
         'payment_mode'=>'required',
          ]);

            $freelancer=Seller::find($trainer_id);
            $freelancer->experience= $request->trainer_experince;
            $freelancer->city= $request->trainer_city;
            $freelancer->expertise= $request->trainer_expertize;
            $freelancer->payment_mode= $request->payment_mode;
            $freelancer->type_of_expertise= $request->trainer_area_expertize;
            $freelancer->gender= $request->gender;
            $freelancer->gym_address= $request->trainer_address;
            $freelancer->zip= $request->trainer_zip;
            $freelancer->category_id= '6';
            $freelancer->gym_name= $request->trainer_name;
            if($request->trainer_area_expertize=='Yoga Trainer')
            {
              $freelancer->category_id= '7';
            }
            if($freelancer->save())
            {
                $user_id=$freelancer->user_id;
                $user=  User::find($user_id);
                $user->name= $request->trainer_name;
                $user->phone_no= $request->trainer_tel;
                $user->save();
                  $message="<b>You have successfully updated your detail."; 
                  return redirect()->back()->with(['success' => $message]);
            }


  }
  public function addtrainer()
    {
        $cities = gymCity::all();
        return view('admins.add-trainer',compact('cities'));
    }
    public function addTrainerPost(Request $request)
    {
         
      $this->validate($request,[
         'trainer_name'=>'required',
         'trainer_email'=>'required|email|unique:users,email',
         'trainer_address'=>'required|min:10',
         'trainer_zip'=>'required|min:6|numeric',
         'trainer_tel'=>'required|min:10|numeric',
         'trainer_city' =>'required',
         'trainer_expertize' =>'required',
         
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
            $user->status= '1';
            $password='welcome@1';
            $user->password=Hash::make($password);
            if($user->save())
            {
                $user->assignRole('freelancer');
                $freelancer=new Seller;
                $user_id=$user->id;
                $freelancer->user_id= $user_id; 
                $freelancer->experience= $request->trainer_experince;
                $freelancer->city= $request->trainer_city;
                $freelancer->expertise= $request->trainer_expertize;
                $freelancer->payment_mode= $request->payment_mode;
                $freelancer->type_of_expertise= $request->trainer_area_expertize;
                $freelancer->gender= $request->gender;
                $freelancer->gym_address= $request->trainer_address;
                $freelancer->zip= $request->trainer_zip;
                $freelancer->seller_type= '2';
                $freelancer->category_id= '6';
                $freelancer->status= '1';
                $freelancer->gym_name= $request->trainer_name;
                if($request->trainer_area_expertize=='Yoga Trainer')
                {
                  $freelancer->category_id= '7';
                }
            
                if($freelancer->save())
                {
                  
                  $this->sendTrainerApprovalEmail($user,$password);
                  $message="You have successfully submitted a trainer detail. Email has been sent to registed email id with login credentials."; 
                        return redirect()->back()->with(['success' => $message]);
                }
            }
                
        }
        public function sendTrainerApprovalEmail($user,$password)
        {
          
           Mail::send('email.approve-trainer', [
            'user'=>$user,
            'password'=>$password
          ], function($message) use ($user) {
              $message->to($user->email,'Near Gym');
              $message->subject("Hello $user->name, Welcome to the Near Gym");
            });
        }

  public function getAllAssignedWorkouts()
  {
    $myworkouts=assignWorkout::where(['status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")
    ->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('admins.workoutlog',compact('myworkouts'));
  }
  public function assignWorkouts(Request $request)
  {
      // $mycustomers=userOrder::where(['status'=>'1'])
      //   ->with('gymdetail','userDetail')
      //   ->groupBy('user_id')
      //   ->orderBy('id','DESC')
      //   ->get();
    $myPackages=orderPackage::with('packageDetails','orderDetails')->
      whereHas('orderDetails', function ($query){
          $query->where(['status'=>'1']);})
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
      ->whereHas('orderDetails', function ($query){
          $query->where(['status'=>'1']);})
      ->get();
        //echo "<pre>";print_r($myOrders->toArray());die;
      return view('admins.workoutassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function workoutsAssign(Request $request)
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
  public function deleteWorkoutsByAdmin(Request $request)
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
  public function getNutritions()
  {
    $mynutritions=assignNutrition::where(['status'=>'1'])
    ->with('userDetail')
    ->orderBy("id","DESC")
    ->get();
    //echo "<pre>";print_r($mynutritions->toArray());die;
    return view('admins.nutrition',compact('mynutritions'));
  }
  public function assignNutritions(Request $request)
  {
      // $mycustomers=userOrder::where(['status'=>'1'])
      //   ->with('gymdetail','userDetail')
      //   ->groupBy('user_id')
      //   ->get();
    $myPackages=orderPackage::with('packageDetails','orderDetails')->
      whereHas('orderDetails', function ($query){
          $query->where(['status'=>'1']);})
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
      ->whereHas('orderDetails', function ($query){
          $query->where(['status'=>'1']);})
      ->get();
        //echo "<pre>";print_r($myOrders->toArray());die;
      return view('admins.nutritionassign',compact('mycustomers','myPackages','packag_id'));
  }
  public function deleteAssignedNutritions(Request $request)
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
  public function assignNutritionsPost(Request $request)
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
        //echo "<pre>";print_r($customer_ids);print_r($alreadyAssign->toArray());die;


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
  public function markOrCheckAttendance(Request $request)
  {
    $user_id=Auth::user()->id;
    $packages=gymPackage::where('status', '=', '1')
      ->with(['packageMemberships' => function ($query) {
              $query->where('status', '=', '1');
          }])
      ->get();
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
        ->whereHas('orderDetails', function ($query) {
        $query->where(['status'=>'1']);})
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
    return view('admins.attendance',compact('packages','mycustomers','present','freelancer_id','package_id','pack_name','formatted_date'));
  }
  public function SubmitAttandance(Request $request)
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
    

}

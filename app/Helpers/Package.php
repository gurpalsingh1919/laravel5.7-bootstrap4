<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\setting;
use Illuminate\Support\Facades\Auth;
use App\assignNutrition;
use App\assignWorkout;
class Package {
/**
* @param int $user_id User-id
* 
* @return string
*/
public static function get_package_price($price,$admin_comission) 
{
   $settings=setting::find(1);

$maintenace_charges=($settings->maintenance_charges*$price)/100;
$tax_percentage=($settings->tax_percentage*$price)/100; ;
$services_charges=($settings->services_charges*$price)/100; 
$admin_comissions=($admin_comission*$price)/100; 
$total_price=$maintenace_charges+$tax_percentage+$services_charges+$admin_comissions+$price; 
  //echo $maintenace_charges.'---'.$tax_percentage.'----'.$services_charges.'---'.$admin_comissions."<br/>";
  return $total_price;
}
public static function get_duration_fullname($val)
{
  $name='';
  $duration=explode('-', $val);
  if(isset($duration[1]) && $duration[1]=="M")
  {
      $name=$duration[0]." MONTH(s)";
  }
  elseif(isset($duration[1]) && $duration[1]=="W")
  {
      $name=$duration[0]." WEEK(s)";
  }
  elseif(isset($duration[1]) && $duration[1]=="Y")
  {
      $name=$duration[0]." YEAR(s)";
  }
  elseif(isset($duration[1]) && $duration[1]=="D")
  {
      $name=$duration[0]." DAY(s)";
  }
  return $name;
}
public static function cancellation_policy($policy)
{
  $cancelpolicy='';
  if($policy=='1')
  {
      $cancelpolicy="Not cancellable";
  }
  elseif($policy=='2')
  {
      $cancelpolicy="At any time cancellation.";
  }
  elseif($policy=='3')
  {
      $cancelpolicy="If cancelled 1 hour prior to the scheduled date & time.";
  }
  elseif($policy=='4')
  {
      $cancelpolicy="If cancelled 2 hour prior to the scheduled date & time.";
  }
  elseif($policy=='5')
  {
      $cancelpolicy="If cancelled 4 hour prior to the scheduled date & time.";
  }
  elseif($policy=='6')
  {
      $cancelpolicy="If cancelled 8 hour prior to the scheduled date & time.";
  }
  elseif($policy=='7')
  {
      $cancelpolicy="If cancelled 12 hour prior to the scheduled date & time.";
  }
  elseif($policy=='8')
  {
      $cancelpolicy="If cancelled 1 day prior to the scheduled date & time.";
  }
  elseif($policy=='9')
  {
      $cancelpolicy="If cancelled 2 day prior to the scheduled date & time.";
  }
  elseif($policy=='10')
  {
      $cancelpolicy="If cancelled 3 day prior to the scheduled date & time.";
  }
  elseif($policy=='11')
  {
      $cancelpolicy="If cancelled 7 day prior to the scheduled date & time";
  }
  return $cancelpolicy;
 
}
  public static function getUserNotifications()
  {
    if (Auth::check())
    {
      $user_id=Auth::user()->id;
      //echo  $user_id;die;
      $myNutritions=assignNutrition::where(['user_id'=>$user_id,'seen'=>'0','status'=>'1'])
      ->with('sellerDetail')
      ->get();
      return $myNutritions;
      //echo "<pre>";print_r($myNutritions->toArray());die;
    }
  }
  public static function getUserWorkouts()
  {
    if (Auth::check())
    {
      $user_id=Auth::user()->id;
      //echo  $user_id;die;
      $myWorkouts=assignWorkout::where(['user_id'=>$user_id,'seen'=>'0','status'=>'1'])
      ->with('sellerDetail')
      ->get();
      return $myWorkouts;
      //echo "<pre>";print_r($myNutritions->toArray());die;
    }
  }
  public static function product_colors()
  {
    $color=array();
    $color['1']='Black';
    $color['2']='White';
    $color['3']='Blue';
    $color['4']='Red';
    $color['5']='Green';
    return $color;
  }
  public static function product_sizes()
  {
    $color=array();
    $color['1']='S';
    $color['2']='M';
    $color['3']='L';
    $color['4']='XL';
    $color['5']='XXL';
    $color['5']='XXXL';
    return $color;
  }
  public static function am_timing()
  {
    $amTime=array();
    $amTime['1']='12:00 AM';
    $amTime['2']='12:15 AM';
    $amTime['3']='12:30 AM';
    $amTime['4']='12:45 AM';
    $amTime['5']='1:00 AM';
    $amTime['6']='1:15 AM';
    $amTime['7']='1:30 AM';
    $amTime['8']='1:45 AM';
    $amTime['9']='2:00 AM';
    $amTime['10']='2:15 AM';
    $amTime['11']='2:30 AM';
    $amTime['12']='2:45 AM';
    $amTime['13']='3:00 AM';
    $amTime['14']='3:15 AM';
    $amTime['15']='3:30 AM';
    $amTime['16']='3:45 AM';
    $amTime['17']='4:00 AM';
    $amTime['18']='4:15 AM';
    $amTime['19']='4:30 AM';
    $amTime['20']='4:45 AM';
    $amTime['21']='5:00 AM';
    $amTime['22']='5:15 AM';
    $amTime['23']='5:30 AM';
    $amTime['24']='5:45 AM';
    $amTime['25']='6:00 AM';
    $amTime['26']='6:15 AM';
    $amTime['27']='6:30 AM';
    $amTime['28']='6:45 AM';
    $amTime['29']='7:00 AM';
    $amTime['30']='7:15 AM';
    $amTime['31']='7:30 AM';
    $amTime['32']='7:45 AM';
    $amTime['33']='8:00 AM';
    $amTime['34']='8:15 AM';
    $amTime['35']='8:30 AM';
    $amTime['36']='8:45 AM';
    $amTime['37']='9:00 AM';
    $amTime['38']='9:15 AM';
    $amTime['39']='9:30 AM';
    $amTime['40']='9:45 AM';
    $amTime['41']='10:00 AM';
    $amTime['42']='10:15 AM';
    $amTime['43']='10:30 AM';
    $amTime['44']='10:45 AM';
    $amTime['45']='11:00 AM';
    $amTime['46']='11:15 AM';
    $amTime['47']='11:30 AM';
    $amTime['48']='11:45 AM';
    $amTime['49']='All day';


    return $amTime;
  }
  public static function pm_timing()
  {
    $pmTime=array();
    $pmTime['1']='12:00 PM';
    $pmTime['2']='12:15 PM';
    $pmTime['3']='12:30 PM';
    $pmTime['4']='12:45 PM';
    $pmTime['5']='1:00 PM';
    $pmTime['6']='1:15 PM';
    $pmTime['7']='1:30 PM';
    $pmTime['8']='1:45 PM';
    $pmTime['9']='2:00 PM';
    $pmTime['10']='2:15 PM';
    $pmTime['11']='2:30 PM';
    $pmTime['12']='2:45 PM';
    $pmTime['13']='3:00 PM';
    $pmTime['14']='3:15 PM';
    $pmTime['15']='3:30 PM';
    $pmTime['16']='3:45 PM';
    $pmTime['17']='4:00 PM';
    $pmTime['18']='4:15 PM';
    $pmTime['19']='4:30 PM';
    $pmTime['20']='4:45 PM';
    $pmTime['21']='5:00 PM';
    $pmTime['22']='5:15 PM';
    $pmTime['23']='5:30 PM';
    $pmTime['24']='5:45 PM';
    $pmTime['25']='6:00 PM';
    $pmTime['26']='6:15 PM';
    $pmTime['27']='6:30 PM';
    $pmTime['28']='6:45 PM';
    $pmTime['29']='7:00 PM';
    $pmTime['30']='7:15 PM';
    $pmTime['31']='7:30 PM';
    $pmTime['32']='7:45 PM';
    $pmTime['33']='8:00 PM';
    $pmTime['34']='8:15 PM';
    $pmTime['35']='8:30 PM';
    $pmTime['36']='8:45 PM';
    $pmTime['37']='9:00 PM';
    $pmTime['38']='9:15 PM';
    $pmTime['39']='9:30 PM';
    $pmTime['40']='9:45 PM';
    $pmTime['41']='10:00 PM';
    $pmTime['42']='10:15 PM';
    $pmTime['43']='10:30 PM';
    $pmTime['44']='10:45 PM';
    $pmTime['45']='11:00 PM';
    $pmTime['46']='11:15 PM';
    $pmTime['47']='11:30 PM';
    $pmTime['48']='11:45 PM';
    $pmTime['49']='All day';
    return $pmTime;
  }
  public static function week_days()
  {
    $week_days=array();
    $week_days['1']='Monday';
    $week_days['2']='Tuesday';
    $week_days['3']='Wednesday';
    $week_days['4']='Thursday';
    $week_days['5']='Friday';
    $week_days['6']='Saturday';
    $week_days['7']='Sunday';
    return $week_days;
  }
}
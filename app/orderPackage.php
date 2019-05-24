<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderPackage extends Model
{
    public function packageDetails()
    {
        return  $this->hasOne('App\gymPackage', 'id', 'gym_package_id');
    }
    public function orderDetails()
    {
        return  $this->hasOne('App\userOrder', 'id', 'user_order_id');
    }
    public function membershipDetails()
    {
        return  $this->hasOne('App\gymMembership', 'id', 'gym_membership_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userOrder extends Model
{
    public function gymdetail()
    {
        return  $this->hasOne('App\Seller', 'id', 'gym_id');
    }
    public function orderDetail()
    {
        return  $this->hasMany('App\orderPackage', 'user_order_id', 'id');
    }
    public function userDetail()
    {
        return  $this->hasOne('App\User', 'id', 'user_id');
    }


}

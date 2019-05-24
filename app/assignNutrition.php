<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignNutrition extends Model
{
    public function userDetail()
    {
        return  $this->hasOne('App\User', 'id', 'user_id');
    }
    public function sellerDetail()
    {
        return  $this->hasOne('App\Seller', 'id', 'assigne_id');
    }
}

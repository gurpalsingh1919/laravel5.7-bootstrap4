<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gymPackage extends Model
{
    public function gymDetail()
    {
        //return $this->hasMany('App\gymPackage');
        return  $this->belongsTo('App\Seller', 'seller_id', 'id');
    }
    public function packageMemberships()
    {
       return  $this->hasMany('App\gymMembership', 'package_id', 'id');
    }
    public function pack_categories()
    {
        //return $this->hasOne('App\gymLocation');
        return  $this->hasOne('App\gymPackageType', 'id', 'package_type_id');
    }
}

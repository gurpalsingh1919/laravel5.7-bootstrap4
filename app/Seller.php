<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function packages()
    {
        //return $this->hasMany('App\gymPackage');
        return  $this->hasMany('App\gymPackage', 'seller_id', 'id');
    }
    public function locations()
    {
        //return $this->hasOne('App\gymLocation');
        return  $this->hasOne('App\gymLocation', 'seller_id', 'id');
    }
    public function categories()
    {
        //return $this->hasOne('App\gymLocation');
        return  $this->hasOne('App\gymCategory', 'id', 'category_id');
    }
    public function products()
    {
        //return $this->hasMany('App\gymPackage');
        return  $this->hasMany('App\gymProduct', 'seller_id', 'id');
    }
    public function store_category()
    {
        //return $this->hasOne('App\gymLocation');
        return  $this->hasOne('App\storeCategory', 'id', 'business_category');
    }

}

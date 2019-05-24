<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gymProduct extends Model
{
    public function gymDetail()
    {
        return  $this->belongsTo('App\Seller', 'seller_id', 'id');
    }
    public function productCategories()
    {
        //return $this->hasOne('App\gymLocation');
        return  $this->hasOne('App\productCategory', 'id', 'category');
    }
}

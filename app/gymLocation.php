<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gymLocation extends Model
{
   public function Sellers()
   {
    	//return $this->belongsTo('App\Seller');
    	return $this->belongsTo('App\Seller', 'seller_id', 'id')->select('*');
   }
}

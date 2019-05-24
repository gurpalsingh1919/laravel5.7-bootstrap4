<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','image', 'password','phone_no','status', 'provider', 'provider_id','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function seller()
    {
        return $this->hasOne('App\Seller');
    }
    public function isAdministrator()
    {
       return $this->hasRole('admin');
    } 
    public function isSeller()
    {
       return $this->hasRole('seller');
    } 
    public function isFreelancer()
    {
       return $this->hasRole('freelancer');
    } 
    public function isSalesExecutive()
    {
       return $this->hasRole('salesexecutive');
    } 
}

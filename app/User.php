<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //check admin
    public function isAdmin()
    {
        return $this->admin;
    }

    public function address()
    {
        return $this->hasMany('App\Address');
    }
    //1 user many orders
    public function order()
    {
        return $this->hasMany('App\Order');
    }


}

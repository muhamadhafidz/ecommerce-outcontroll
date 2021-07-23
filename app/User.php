<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function address()
    {
        return $this->hasMany('App\User_address', 'user_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'user_id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'user_id');
    }
    
}

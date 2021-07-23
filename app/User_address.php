<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'address', 'product_name', 'kota_id','provinsi_id', 'post_code', 'no_telp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'user_address';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

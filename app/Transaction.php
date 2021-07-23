<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ongkir_price', 'total_price', 'status', 'name_user', 'address'
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
    // protected $table = 'user_address';
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transaction_product()
    {
        return $this->hasMany('App\Transaction_product', 'transaction_id');
    }

    public function resi()
    {
        return $this->hasOne('App\Resi', 'transaction_id');
    }

    public function bukti()
    {
        return $this->hasOne('App\Bukti', 'transaction_id');
    }
}

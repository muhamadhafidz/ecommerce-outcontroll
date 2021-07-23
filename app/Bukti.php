<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'dir_payment_pic',
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
    protected $table = 'bukti';

    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'transaction_id');
    }
}

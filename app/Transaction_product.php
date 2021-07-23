<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'product_name', 'qty', 'price', 'size'
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
    protected $table = 'transaction_products';

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'transaction_id');
    }
}

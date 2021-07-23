<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'size', 'price', 'stock'
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
    protected $table = 'product_details';

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'detail_id');
    }
}

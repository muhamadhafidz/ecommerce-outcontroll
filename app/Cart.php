<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'user_id', 'detail_id', 'qty',
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
    protected $table = 'carts';

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\Product_detail', 'detail_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

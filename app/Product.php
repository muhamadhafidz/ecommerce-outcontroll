<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'active', 'sold'
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
    protected $table = 'products';

    public function detail()
    {
        return $this->hasMany('App\Product_detail', 'product_id');
    }
    public function images()
    {
        return $this->hasMany('App\Product_image', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}

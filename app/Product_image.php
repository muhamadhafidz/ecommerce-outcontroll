<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'dir_photo', 'number'
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
    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    
}

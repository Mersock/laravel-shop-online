<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Product extends Model
{    
    protected $table = 'products';
    protected $fillable = ['name','description','size','price','image','active','category_id'];

    public function  category()
    {
        return $this->belongsTo('App\Category');
    }

    // 1 order many product
    public function ProductItems()
    {
       return $this->belongsToMany('App\Order','order_product');
    }
}

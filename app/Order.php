<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Cart;

class Order extends Model
{
    protected  $fillable=['no','date','total','delivered'];


    // 1 order many product
    public function orderItems()
    {
       return $this->belongsToMany('App\Product','order_product')->withPivot('qty', 'total_amout');
        //  return $this->belongsToMany('App\Product','order_product')->withTimestamps('qty', 'total_amout');
    }

    public static function CreateOrder()
    {
        $user = Auth::user();
        $Max_OrderNo = Order::max('no');
        $order = $user->order()->create([
            'no' => $Max_OrderNo+1,
            'total'=> Cart::subtotal(),
            'delivered' => 0,
            'date'=> date('d/m/').(date('Y')+543),
        ]);

        $cartItems = Cart::content();   
        //order_product
        foreach($cartItems as $cartItem){
            $order->orderItems()->attach($cartItem->id,[
                'qty'=> $cartItem->qty,
                'total_amout'=> $cartItem->qty * $cartItem->price
            ]);
        }
        return $order;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}

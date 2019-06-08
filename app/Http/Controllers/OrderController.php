<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use Auth;

use App\Mail\Shipping;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function orders($type='')
    {
        ## ยังไม่ได้ส่ง
        if($type=='pending'){
              ## ยังไม่ได้ส่ง
            $orders = Order::where('delivered','0')->get();
        }elseif($type=='delivered'){
              ## ส่งแล้ว
            $orders = Order::where('delivered','1')->get();
        }else{
            $orders = Order::all();
        }

        return view('admin.orders.index',compact('orders'));
    }

    public function orderUser(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(5);
        return view('front.order_history',compact('orders'));
    }
    
    public function setOrders(Request $request,$orderId)
    {
        $order = Order::find($orderId);
        if($request->has('delivered')){

            Mail::to($order->user->email)->send(new Shipping($order));

            $order->delivered = $request->delivered;
        }else{
            $order->delivered= '0' ;
        }
        $order->save();

        return back();
    }
}

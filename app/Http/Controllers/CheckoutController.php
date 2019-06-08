<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Cart;

use App\Order;

use App\Address;

class CheckoutController extends Controller
{
    

    // public function checkAuth()
    // {
        //check auth
    //     if(Auth::check()){
    //         return redirect()->route('checkout.shipping');
    //     }
    //     return redirect()->route('login');
    // }

    public function shipping()
    {
        $address = Address::where('user_id',Auth::user()->id)->get();
        // dd($address);
        return view('front.shipping',compact('address'));
    }

    public function payment()
    {
        return view('front.payment');
    }

    public function storePayment(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_d03niiz4otbEz8syEqXbFQKR");
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;
        $charge = \Stripe\Charge::create([
            //หากเป็นจำนวนเช่น 333 จะได้ค่า 3.33 bath จึง *100 ไป
            //บังคับขั้นต่ำ 20 baht thai
            //'amount' => 20*100,
            // 'amount' => intval(Cart::subtotal())*100,
            'amount' => Cart::total()*100,
            'currency' => 'THB',
            'description' => 'Example charge',
            'source' => $token,
        ]);
        ###สร้าง order###
        $order = Order::CreateOrder();
        $address = Address::where('user_id',Auth::user()->id)->get();
        //ลบ cart เดิม
        Cart::destroy();

        return view('front.shoping_success',compact('order','address'));
    }

}

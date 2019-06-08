<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::content();
        // dd($cartItems);
        
        return view('cart.index',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $product = Product::find($id);

        // Cart::add($product->id,$product->name,1,$product->price,['size'=>'M']);

        // return back();

    }


    public function addItems(Request $request,$id)
    {
        // dd($product);
        if($request->ajax()){
            $product = Product::find($id);
            $cart = Cart::add($product->id,$product->name,1,$product->price,['size'=>$product->size]);
            $count = Cart::count();
            return response()->json($count);
        }

        //return back();

    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cart::update($id, $request->qty);
        // return back();
        if($request->ajax()){
            $cart =  Cart::update($id, $request->qty);
            $count = Cart::count();
            $total = Cart::total();
            // $total = Cart::subtotal();
            return response()
                    ->json([
                    'cart' => $cart,
                    'count' => $count,
                    'total'=> number_format($total,2)
                    ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){
            Cart::remove($id);
            $count = Cart::count();
            $total = Cart::total();
            $remove_id = $id;
            return response()->json([
                'msg' => 'success',
                'count'=>$count,
                'total'=>$total,
                'remove_id'=>$remove_id
            ]);
        }
    }
}

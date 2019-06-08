<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class FrontController extends Controller
{
    public function index()
    {
      $products = $this->findPage();
       return view('front.home',compact('products'));
    }

    public function findPage()
    {
       return $products = Product::where('active',1)->paginate(4);
    }

    public function homePage()
    {
        $products = $this->findPage();
        return view('front.pagination.homePaginate',compact('products'))->render();

    }

    // public function detail()
    // {
    //     $products = Product::all();
    //     return view('front.detail',compact('products'));
    // }
}

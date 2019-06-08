<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

use Illuminate\Support\Facades\Storage;

use File;

use Validator;

class ProductsController extends Controller
{


    public function index()
    {
        $products = $this->findPage();
        $categories = Category::pluck('name','id');
        return view('admin.product.index',compact('products','categories'));
    }

    ###page###
    public function findPage()
    {
        return Product::with('category')->orderBy('id','asc')->paginate(5);
    }

    public function productPage()
    {
        $products = $this->findPage();

        return view('admin.product.productPage',compact('products'))->render();
    }
    ###page###

    public function view()
    {
        $products = Product::all();
        return view('admin.product.view',compact('products'));
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            //validate form 
            $validator  = Validator::make($request->all(),[
                'name' => 'required|max:190',
                'description' => 'required|max:190',
                'size' => 'required|max:190',
                'category' => 'required|max:190',
                'image' => 'image|mimes:jpg,jpeg,bmp,png|max:10000',
                'active'=> 'required|boolean',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 'fails',
                    'error'=>$validator->errors()->all()
                    ]);
            }

            if($request->image){
              $image = $request->image;
              $image_name = str_random(10).time().'.'.$image->getClientOriginalExtension();
              //$image_file = $image->getClientOriginalName();
              $image->move(public_path('images/product_image'),$image_name);
            }

            // $data['category_id'] = $request->category;
            // $data['image'] = $request->image;
            // $data['description'] = $request->description;
            // $data['size'] = $request->size;
            // $data['name'] = $request->name;
            //$data = $request->all();
            $data = $request->except(['category_id','image']);
            $data['category_id'] = $request->category;
            $data['image'] = $image_name??'';
            $products = Product::create($data);
            $products = Product::join('categories','products.category_id','=','categories.id')
                                ->where('products.id',$products->id)
                                ->select('products.*','products.name as product_name','categories.name as catgory_name')
                                ->first();
            return response()->json([
            'status' => 'success',
            'products' => $products
            ]);

        }
    }


    public function edit(Request $request)
    {
        if($request->ajax()){
            $product = Product::find($request->id);
            return response($product);
        }
    }


    public function update(Request $request)
    {
        if($request->ajax()){

            $validator  = Validator::make($request->all(),[
                'name' => 'required|max:190',
                'description' => 'required|max:190',
                'size' => 'required|max:190',
                'category' => 'required|max:190',
                'image' => 'image|mimes:jpg,jpeg,bmp,png|max:10000',
                'active'=> 'required|boolean',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 'fails',
                    'error'=>$validator->errors()->all()
                    ]);
            }

            if($request->image){
                $image = $request->image;
                $image_name = str_random(10).time().'.'.$image->getClientOriginalExtension();
                //$image_file = $image->getClientOriginalName();
                $image->move(public_path('images/product_image'),$image_name);
              }


            $data = $request->except(['category_id','image']);
            $data['category_id'] = $request->category;

            $products = Product::find($request->id);
            $oldimage = $products->image;

            if($request->hasFile('image')){
                File::delete('images/product_image/'.$oldimage);
            }  

            $data['image'] = $image_name??$oldimage;
            $products->update($data);

            $count_product = $products->ProductItems()->count();
            //ส่งกลับไป
            //$return_product = Product::find($products->id);
            $return_product = Product::join('categories','products.category_id','=','categories.id')
                                ->where('products.id',$products->id)
                                ->select('products.*','products.name as product_name','categories.name as catgory_name')
                                ->first();
            return response()->json([
                'status' => 'success',
                'products' => $return_product,
                'count_product' => $count_product,
            ]);
        }
    }


    public function destroy(Request $request)
    {
        if($request->ajax()){
            $product = Product::find($request->id);
            File::delete('images/product_image/'.$product->image);
            Product::destroy($request->id);
            return response(['msg'=>'Product Deleted']);
        }
    }


}

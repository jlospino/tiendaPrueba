<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
use \App\Category;
use \App\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function getProducts(Request $request) {
        $products = Product::orderBy('name','desc')->with('category')->get();
        $data = array();
        foreach($products as $p) {
            $data[] = array(
                "id" => $p->id,
                "name" => $p->name,
                "description" => $p->description,
                "price" => $p->price,
                "category" => $p->category->name,
                "quantity" => $p->quantity,
                "photo" => $p->photo,
                "slug" => $p->slug,
                "userId" => 0
            );
        }
        return response()->json($data);
    }

    public function show($slug) {
        $product = Product::whereSlug($slug)->first();
        return view('products.show', ['product' => $product]);
    }

    public function create() {
        $categories = Category::orderBy('name', 'desc')->get();
        $vendors = Vendor::orderBy('name', 'desc')->get();
        return view('products.create', ['categories' => $categories, 'vendors' => $vendors ]);
    }

    public function store(Request $request) {
       // dd($request->all());
        DB::beginTransaction();
        try{
            $file = $request->photo;
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name , "-");
            $product->description = $request->description;
            if(isset($file)) {
                $imagedata = file_get_contents($file);
                $base64 = base64_encode($imagedata);
                $product->photo = $base64;
            }
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category;
            $product->vendor_id = $request->vendor;
            $product->save();
            DB::commit();
            return redirect()->route('home');
        }catch (\Throwable $e) {
            $e->getMessage();
            DB::rollback();
            return redirect()->route('create')->with(['error_save' => 'Error! Intenta más tarde']);
        }
    }

    public function edit($slug) {
        $product = Product::whereSlug($slug)->first();
        $categories = Category::orderBy('name', 'desc')->get();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request) {
         DB::beginTransaction();
         try{
             $file = $request->photo;
             $product = Product::find($request->productId);
             $product->name = $request->name;
             $product->slug = Str::slug($request->name , "-");
             $product->description = $request->description;
             if(isset($file)) {
                 $imagedata = file_get_contents($file);
                 $base64 = base64_encode($imagedata);
                 $product->photo = $base64;
             }
             $product->price = $request->price;
             $product->quantity = $request->quantity;
             $product->category_id = $request->category;
             $product->save();
             DB::commit();
             return redirect()->route('home');
         }catch (\Throwable $e) {
             $e->getMessage();
             DB::rollback();
             return redirect()->route('edit')->with(['error_save' => 'Error! Intenta más tarde']);
         }
     }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
    }
}

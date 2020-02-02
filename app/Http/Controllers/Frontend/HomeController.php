<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        $products = Product::inRandomOrder()->get();
        $categories = Category::with('children')->where('parent_id', '=', null)->get();
        return view('frontend.home.home', compact('products', 'categories'));
    }


    public function products($url)
    {
        // if url slug is not match our recoud show 404 page
        $chack = Category::where('slug', $url)->count();
        if ($chack == 0){
            return view('errors.403');
        }

        // get all category
        $categories = Category::with('children')->where('parent_id', '=', null)->get();
        // get search slug category
        $catgori = Category::where('slug', $url)->first();

        if ($catgori->parent_id == null){
            // if slug is main category
            $sub_category = Category::where('parent_id',$catgori->id)->pluck('id');
            $mainId = $catgori->id;
            $sub = $sub_category->toArray();
            array_push($sub,$mainId);
            $products = Product::whereIn('category_id',$sub)->get();
        }else{
            // if url is sub category
            $products = Product::where('category_id',$catgori->id)->get();
        }
        return view('frontend.home.home', compact('products', 'categories', 'catgori'));
    }


    public function productDetail($url = null){
        $product = Product::with('attributes')->where('slug', '=', $url)->first();
        // chack valid url
        if (!$product){
            return view('errors.403');
        }
        $relatedProducts = Product::where('id', '!=', $product->id)->where('category_id', '=',$product->category_id)->get();
        $product_stock = ProductAttribute::where('product_id', $product->id)->sum('stock');
        return view('frontend.pages.product_detail', compact('product', 'product_stock', 'relatedProducts'));

    }

    public function getProductSizeWisePrice(Request $request)
    {
        $data = $request->all();
        $finalData = explode("-",$data['idSize']);
        $sendData =  ProductAttribute::where(['product_id' => $finalData[0], 'size' => $finalData[1]])->first();
        return response()->json([$sendData->price, $sendData->stock]);
    }



}

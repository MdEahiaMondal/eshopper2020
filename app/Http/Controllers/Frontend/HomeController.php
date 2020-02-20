<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\CmsPage;
use App\Currencie;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        $products = Product::inRandomOrder()->get();
        $categories = Category::with('children')->where('parent_id', '=', null)->get();
        return view('frontend.home.home', compact('products', 'categories'));
    }


    public function products($url = null)
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
        $getCurrencies = Product::getCurrencyRates($sendData->price);
        return response()->json([$sendData->price, $sendData->stock, $getCurrencies]);
    }


    public function searchProducts(Request $request)
    {
        // get all category
        $categories = Category::with('children')->where('parent_id', '=', null)->get();
        $searchText = $request->search_product;
        // get search slug category
//        $products = Product::where('name', 'like', '%'.$request->search_product. '%')->orWhere('code', $request->search_product)->get();
        $products = Product::where(function ($query) use($searchText){
            $query->where('name', 'like', '%'.$searchText. '%')->orWhere('code', $searchText)->orWhere('details', $searchText);
        })->get();
        $searchName = $request->search_product;
        return view('frontend.home.home', compact('products', 'categories', 'searchName'));
    }


    public function searchProductsWithColor(Request $request)
    {
        $colorUrl = '';
        if (!empty($request->colorFilter)) // if not empty color array
        {
            foreach ($request->colorFilter as $color)
            {
                if (empty($colorUrl))
                {
                    $colorUrl .= "color=".$color;
                }else{
                    $colorUrl .= "-".$color;
                }
            }
            $finalUrl = 'products/filter/search'."?".$colorUrl;
            return redirect($finalUrl);
        }else{
            return redirect('/');
        }
    }


    public function searchColorProduct(Request $request)
    {
        $colorArr = explode('-', $request->color);
        $products = Product::whereIn('color',$colorArr)->get();
        // get all category
        $categories = Category::with('children')->where('parent_id', '=', null)->get();
        return view('frontend.home.home', compact('products', 'categories'));
    }



    public function cmsPages($url)
    {

        $check = CmsPage::where('slug', $url)->count();
        if ($check > 0)
        {
            $categories = Category::with('children')->where('parent_id', '=', null)->get();
            $cms = CmsPage::where('slug', $url)->first();
            return view('frontend.pages.cms_pages', compact('cms', 'categories'));
        }else{
            return view('errors.403');
        }

    }


    public function ContactUs()
    {
        return view('frontend.pages.contact_us');
    }



    public function ContactUsSend(Request $request)
    {

        $request->validate([
           'email' => 'required',
           'name' => 'required',
           'subject' => 'required',
           'message' => 'required',
        ]);

        // send to eknojorbd88@gmail.com
        $email = "eknojorbd88@gmail.com";
        $messateData = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'comment' => $request->message,
        ];

        Mail::send('frontend.mail.contact_us', $messateData, function ($message) use($email){
            $message->to($email)->subject('Enquiry from  E-shopper-2020');
        });

        return redirect()->back()->with('success', 'Your enquiry is successfully send!');
    }



}

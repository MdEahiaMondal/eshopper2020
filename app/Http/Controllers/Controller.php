<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function mainCategory()
    {
        $category = Category::where('parent_id', null)->get();
        return $category;
    }

    public static function cartItem()
    {

        if (auth()->check()){
            $carts = Cart::where('user_email', '=', auth()->user()->email)->get();
        }else{
            $session_id = Session::get('session_id');
            $carts = Cart::where('session_id', '=', $session_id)->get();
        }
        return $carts;
    }



}

<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{


    public function index()
    {
        $wishlists = Wishlist::where('user_email', Auth::user()->email)->get();
        return view('frontend.pages.wishlist', compact('wishlists'));
    }

    public function addToCart(Request $request)
    {

        // check alredy exist or not
        $checkCart = Cart::where([
            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'product_sku_code' => $request->sku,
            'user_email' => Auth::user()->email,
        ])->count();

        if ($checkCart > 0)
        {
            return redirect()->back()->with('error', 'Product Alredy Exist in you Cart');
        }

        Cart::create([
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_sku_code' => $request->sku,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'quantity' => 1,
            'user_email' => Auth::user()->email,
            'session_id' => '',
        ]);
        Wishlist::where([
            'user_email' => Auth::user()->email,
            'product_id' => $request->product_id,
            'color' => $request->color,
            'size' => $request->size,
            'product_sku_code' => $request->sku,
        ])->delete();
        return redirect()->back()->with('success', 'Successfully add to your cart');
    }


    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->back()->with('success', 'Successfully deleted to your wishlist');
    }


}

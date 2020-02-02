<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Coupon;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index()
    {

        if (auth()->check()){
            $carts = Cart::where('user_email', '=', auth()->user()->email)->get();
        }else{
            $session_id = Session::get('session_id');
            $carts = Cart::where('session_id', '=', $session_id)->get();
        }
        return view('frontend.pages.cart_details', compact('carts'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'productSize' => 'required'
        ]);

        $data = $request->all();
        if (auth()->check()){
            $data['user_email'] = auth()->user()->email;
        }

        $session_id = Session::get('session_id');
        if (empty($session_id))
        {
            $session_id = Str::random(40);
            Session::put('session_id',$session_id);
        }

        if (!empty($data['productSize'])){
            $data['size'] = explode($data['product_id'].'-',$data['productSize']);
        }

        // ckack the product already exist
        $check = Cart::where([
            'product_id' => $data['product_id'],
            'color' => $data['color'],
            'size' => $data['size'][1],
            'session_id' => $session_id,
        ])->count();

        if ($check){
            return redirect()->back()->with('error', 'Product Alredy Exist in you cart');
        }

        $productSkuCode = ProductAttribute::select('sku')->where(['product_id' => $data['product_id'], 'size' =>$data['size'][1]])->first();
        Cart::create([
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'product_sku_code' => $productSkuCode->sku,
            'price' => $data['price'],
            'color' => $data['color'],
            'size' => $data['size'][1],
            'quantity' => $data['quantity'],
            'user_email' => $data['user_email'],
            'session_id' => $session_id,
        ]);

        // if the user use coupon code and if add to cart item then coupon session forget
        // we need to forget old coupon code and amount
        Session::forget('couponAmount');
        Session::forget('couponCode');

        return redirect()->back()->with('success', 'Product add to cart success !');
    }


    public function cartUpdateIncrement($id)
    {

        // if the user use coupon code and if increment cart item then coupon session forget
        // we need to forget old coupon code and amount
        Session::forget('couponAmount');
        Session::forget('couponCode');

        // chack the quantity available in our stock
        $getProduct = Cart::findOrFail($id);
        $checkStock = ProductAttribute::select('stock')->where(['sku' => $getProduct->product_sku_code, 'size' => $getProduct->size])->first();
        $finalStock = $getProduct->quantity + 1;
        if ($checkStock->stock >= $finalStock) {
            Cart::where('id', '=', $id)->increment('quantity');
            return redirect()->back()->with('success', 'Product Quantity Updated success !');
        }
        return redirect()->back()->with('error', 'Product Quantity not available!');
    }

    public function cartUpdateDecrement($id)
    {
        // if the user use coupon code and if decrement cart item then coupon session forget
        // we need to forget old coupon code and amount
        Session::forget('couponAmount');
        Session::forget('couponCode');

         Cart::where('id', '=', $id)->decrement('quantity');
        return redirect()->back()->with('success', 'Product Quantity Updated success !');
    }


    public function destroy(Cart $cart)
    {
        // if the user use coupon code and if delete cart item then coupon session forget
        // we need to forget old coupon code and amount
        Session::forget('couponAmount');
        Session::forget('couponCode');

        $cart->delete();
        return redirect()->back()->with('success', 'Your cart item deleted success !');
    }


    public function cartApplayCoupon(Request $request)
    {

        // we need to forget old coupon code and amount
        Session::forget('couponAmount');
        Session::forget('couponCode');


        // first chack this coupon is valid or not
        $check = Coupon::where('coupon_code', $request->coupon_code)->count();
        if ($check == 0)
        {
            return redirect()->back()->with('error', 'Your Coupon is not Valid!!');
        }else{
            // now we will check this coupon is active or deactive and date exipry
            $coupon = Coupon::where('coupon_code',$request->coupon_code)->first();
            if ($coupon->status == 0)
            {
                return redirect()->back()->with('error', 'This coupon code is not active !');
            }

            if ($coupon->exipry_date >= date('Y-m-d'))
            {
                // get cart total amount

                if (auth()->check())
                {
                    $userCart = Cart::where('user_email', auth()->user()->email)->get();
                }else{
                    $session_id = Session::get('session_id');
                    $userCart = Cart::where('session_id', $session_id)->get();
                }

                $total_amount = 0;
                foreach ($userCart as $cartItem)
                {
                    $total_amount += ($cartItem->price * $cartItem->quantity);
                }

                // chack coupon amount_type
                if ($coupon->amount_type == 'fixed')
                {
                    $couponAmount = $coupon->amount;
                }else{
                    $couponAmount = $total_amount * ($coupon->amount/100);
                }


                // add coupon code and amount to session
                Session::put('couponAmount',$couponAmount);
                Session::put('couponCode',$request->coupon_code);
                return redirect()->back()->with('success', 'Coupon code successfully applied. You are availing discount!');
            }else{
                return redirect()->back()->with('error', 'This coupon code time over !');
            }

        }



    }

}

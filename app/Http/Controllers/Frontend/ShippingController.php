<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Country;
use App\PostalCode;
use App\Product;
use App\Shipping;
use App\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{


    public function index()
    {
        $countries = Country::all();
        return view('frontend.pages.checkout', compact('countries'));
    }



    public function store(Request $request)
    {
       $request->validate([
           'name' => 'required',
           'email' => 'required',
           'country' => 'required',
           'state' => 'required',
           'city' => 'required',
           'address' => 'required',
           'phone' => 'required',
           'zipcode' => 'required',
       ]);

       $carts = Cart::where('user_email', auth()->user()->email)->get('product_id');
       $total_weight = 0;
       foreach ($carts as $product)
       {
           $product_wit = Product::where('id', $product->product_id)->first()->weight;
           $total_weight += $product_wit;
       }

       Session::forget('shipping_charge');
       $country_wise_charge = ShippingCharge::where('country', $request->country)->first();
       $total_shipping_charge = 0;
       if ($country_wise_charge)
       {
           if ($total_weight > 0 && $total_weight <= 500)
           {
               $total_shipping_charge = $country_wise_charge->shipping_charge_0_500g;
           }
           if ($total_weight >= 501 && $total_weight <= 1000)
           {
               $total_shipping_charge = $country_wise_charge->shipping_charge_501_1000g;
           }
           if ($total_weight >= 1001 && $total_weight <= 2000)
           {
               $total_shipping_charge = $country_wise_charge->shipping_charge_1001_2000g;
           }
           if ($total_weight >= 2001 && $total_weight <= 5000)
           {
               $total_shipping_charge = $country_wise_charge->shipping_charge_2001_5000g;
           }
       }
        Session::put('shipping_charge', $total_shipping_charge);
       $check  = Shipping::where('user_id', auth()->id())->first();
        $request['user_id'] = auth()->id();


        $checkPincode = PostalCode::where('post_code', $request->zipcode)->count();

        if ($checkPincode  == 0)
        {
            return redirect()->back()->with('error', 'Please enter your valid pincode or post code!');
        }

       if (isset($check))
       {
           $shipping_id = Shipping::where(['id' => $check->id,'user_id' => auth()->id()])->first();
           $shipping_id->update([
                'name' => $request->name,
                'email' => $request->email,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'phone' => $request->phone,
                'zipcode' => $request->zipcode,
            ]);
       }else{
           $shipping_id = Shipping::create($request->except('_toke'));
       }

        return redirect()->action(
            'Frontend\ShippingController@ShippingDetaile', ['id' => $shipping_id->id,]
        );
    }


    public function ShippingDetaile($shipping_id)
    {
        if (auth()->check()){
            $carts = Cart::where('user_email', '=', auth()->user()->email)->get();
        }else{
            $session_id = Session::get('session_id');
            $carts = Cart::where('session_id', '=', $session_id)->get();
        }
        $shipping_detail = Shipping::where(['id' => $shipping_id, 'user_id' => auth()->id()])->first();


        return view('frontend.pages.shipping_review', compact('shipping_detail', 'carts'));
    }


}

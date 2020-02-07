<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Country;
use App\PostalCode;
use App\Shipping;
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
            'Frontend\ShippingController@ShippingDetaile', ['id' => $shipping_id->id]
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

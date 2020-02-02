<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Order;
use App\OrderProduct;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{


    public function order(Request $request)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);
        $shipping = Shipping::where('user_id', auth()->id())->first();

        $data = new Order();
        $data ->user_id = auth()->id();
        $data ->shipping_name = $shipping->name;
        $data ->shipping_email = $shipping->email;
        $data ->shipping_country = $shipping->country;
        $data ->shipping_state = $shipping->state;
        $data ->shipping_city = $shipping->city;
        $data ->shipping_zipcode = $shipping->zipcode;
        $data ->shipping_phone = $shipping->phone;
        $data ->shipping_city = $shipping->city;
        $data ->shipping_address = $shipping->city;
        $data ->coupon_code = Session::has('couponCode') ? Session::get('couponCode'): '';
        $data ->coupon_amount = Session::has('couponAmount') ?Session::get('couponAmount'): '';
        $data ->shipping_charge = $request->shipping_charge ? $request->shipping_charge : 0.00;
        $data ->status = 0;
        $data ->payment_method = $request->payment_method;
        $data ->grand_total = $request->grand_total;
        $data->save();
        $carts = Cart::where('user_email', auth()->user()->email)->get();


        foreach ($carts as $cart){
            OrderProduct::create([
                'order_id' => $data->id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product_name,
                'product_size' => $cart->size,
                'product_color' => $cart->color,
                'product_price' => $cart->price,
                'product_quantity' => $cart->quantity,
            ]);
        }


       return view('frontend.pages.order_thanks');
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\ProductAttribute;
use App\Shipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function foo\func;

class OrderController extends Controller
{


    public function order(Request $request)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);
        $shipping = Shipping::where('user_id', auth()->id())->first();
        $carts = Cart::where('user_email', auth()->user()->email)->get();

        //Prevent Sold Out Products to Order
        foreach ($carts as $cart)
        {
            $checkAttributeExistOrNot = ProductAttribute::where(['product_id'=> $cart->product_id, 'size' => $cart->size])->first();


            // product attribute is available or not
            if (!$checkAttributeExistOrNot) // if it is null
            {
                Product::deleteCartProduct($cart->product_id, auth()->user()->email);
                return redirect()->back()->with('warning', ''.$cart->product_name.' is removed. Please try again');
            }

            //out of stock
            if ($checkAttributeExistOrNot->stock == 0)
            {
                //  we need to remove that product whice is out of stock
                Product::deleteCartProduct($cart->product_id, auth()->user()->email);
                return redirect()->back()->with('warning', ''.$cart->product_name.' is removed for out of stock ');
            }
            //  quantity is not available
            if ($checkAttributeExistOrNot->stock < $cart->quantity)
            {
               return redirect()->back()->with('warning', ''.$cart->product_name.' is available quantity is ('.$checkAttributeExistOrNot->stock.') ');
            }
            // product attribute is desible
            $enable= Product::desiableProduct($cart->product_id);
            if (!$enable)
            {
                Product::deleteCartProduct($cart->product_id, auth()->user()->email);
                return redirect()->back()->with('warning', 'Disable product is removed, Please try again');
            }

            // product category status is not enable
            $categoryStatus = Product::where('id', $cart->product_id)->first();
            if ($categoryStatus->productCategory->status == 0)
            {
                Product::deleteCartProduct($cart->product_id, auth()->user()->email);
                return redirect()->back()->with('warning', 'Disable Product Category is removed, Please try again');
            }

        }

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
        $data ->coupon_amount = Session::has('couponAmount') ? Session::get('couponAmount'): 0;
        $data ->shipping_charge = $request->shipping_charge ? $request->shipping_charge : 0.00;
        $data ->status = 0;
        $data ->payment_method = $request->payment_method;
        $data ->grand_total = $request->grand_total;
        $data->save();

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

            /*now we need to reduce the product quantity*/
            $checkStock = ProductAttribute::where(['sku' => $cart->product_sku_code])->first();
            $finalStock =($checkStock->stock - $cart->quantity);
            if ($finalStock < 0)
            {
                $finalStock = 0;
            }
            ProductAttribute::where(['sku' => $cart->product_sku_code])
                ->update(['stock' => $finalStock]); // now updated;
        }

        // now we need to delete cart item
        Cart::where('user_email', auth()->user()->email)->delete();

        if ($request->payment_method == 'cad')
        {
            //send to mail
            $productDetails = Order::with('orderDetails')->where('id', $data->id)->first();
            $userDetails = User::where('id', auth()->id())->first();

//            dd($productDetails);

            $email = auth()->user()->email;
            $messageData = [
                'shippingEmail' => $shipping->email,
                'shipingName' => $shipping->name,
                'order_id' => $data->id,
                'productDetails' => $productDetails,
                'userDetails' => $userDetails,
            ];

            Mail::send('frontend.mail.order_details', $messageData, function ($message) use($email){
                $message->to($email)->subject('Your Order Details From E-Shopper-2020');
            });


            return view('frontend.pages.order_thanks');
        }else{
            return view('frontend.pages.order_thanks');
        }

    }


    public function userOrderView()
    {
       $orders =  Order::where('user_id', auth()->id())->get();
      return view('frontend.pages.user_order_view', compact('orders'));
    }


    public function userOrderDetails($order_id)
    {
        $order_details = Order::with('orderDetails')->where('id', $order_id)->first();
        return view('frontend.pages.user_order_details', compact('order_details'));
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

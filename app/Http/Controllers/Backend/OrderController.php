<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function index()
    {
        $orders = Order::with('orderUser','orderDetails')->latest()->get();
        return view('backend.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        return view('backend.orders.details', compact('order'));
    }

    public function orderInvoice(Order $order)
    {
        return view('backend.orders.invoice', compact('order'));
    }



    public function orderStatusUpdate(Request $request)
    {
        Order::where('id', $request->order_id)->first()->update(['status'=> $request->status]);
        return redirect()->back()->with('success', 'Order Status Successfully Changed');
    }

}

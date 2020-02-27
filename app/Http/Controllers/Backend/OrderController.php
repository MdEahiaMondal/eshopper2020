<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function index()
    {


        $nestedEntry[0] = ['string' =>[
            '0' => 'urlmasking',
            '1' => 'false'
        ]];

        $nestedEntry[1] = ['string' =>[
                '0' => 'forward',
                '1' => 'http://mamun.com'
            ]];
        $nestedEntry[2] = ['string' =>[
            '0' => 'pathforwarding',
            '1' => 'false'
        ]];
        $nestedEntry[3] = ['string' =>[
            '0' => 'pathforwarding',
            '1' => 'false'
        ]];
         $nestedEntry[4] = ['string' =>[
             '0' => 'subdomainforwarding',
             '1' => 'true'
        ]];
        $nestedEntry[5] = ['string' =>[
            '0' => 'ipaddress',
            '1' => "162.215.252.78"
        ]];
        $nestedEntry[6] = ['string' =>[
            '0' => 'domainname',
            '1' => 'plabbd.com'
        ]];


        $nestedEntry1[0] = ['string' =>[
            '0' => 'urlmasking',
            '1' => 'false'
        ]];

        $nestedEntry1[1] = ['string' =>[
            '0' => 'forward',
            '1' => 'http://mamun.com'
        ]];
        $nestedEntry1[2] = ['string' =>[
            '0' => 'pathforwarding',
            '1' => 'false'
        ]];
        $nestedEntry1[3] = ['string' =>[
            '0' => 'pathforwarding',
            '1' => 'false'
        ]];
        $nestedEntry1[4] = ['string' =>[
            '0' => 'subdomainforwarding',
            '1' => 'true'
        ]];
        $nestedEntry1[5] = ['string' =>[
            '0' => 'ipaddress',
            '1' => "162.215.252.78"
        ]];


        $entry['entry'][0] = [
            "string" => "www.plabbd.com",
            'hashtable' => [
                'entry' => $nestedEntry,
            ]
        ];

        $entry['entry'][1] = [
            "string" => "www.plabbd.com",
            'hashtable' => [
                'entry' => $nestedEntry1,
            ]
        ];


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


    public function orderPdfInvoice(Order $order)
    {
        $pdf = PDF::loadView('backend.orders.invoice', compact('order'));
        return $pdf->download('invoice.pdf');
    }


}

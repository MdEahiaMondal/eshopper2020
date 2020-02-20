<?php

namespace App\Http\Controllers\Backend;

use App\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShippingChargeController extends Controller
{

    public function index()
    {
        $shipping_charges = ShippingCharge::all();
        return view('backend.shipping_charge.index', compact('shipping_charges'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(ShippingCharge $shippingCharge)
    {
        //
    }


    public function edit(ShippingCharge $shippingCharge)
    {
        return view('backend.shipping_charge.edit', compact('shippingCharge'));
    }


    public function update(Request $request, ShippingCharge $shippingCharge)
    {
        $shippingCharge->update($request->all());
        return redirect()->route('admin.shipping_charge.index')->with('success', 'Shipping Charge updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingCharge $shippingCharge)
    {
        //
    }
}

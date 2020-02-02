<?php

namespace App\Http\Controllers\Backend;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CouponController extends Controller
{

    public function index()
    {
        $coupons  = Coupon::latest()->get();
        return view('backend.coupons.index', compact('coupons'));
    }


    public function create()
    {
        return view('backend.coupons.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|max:20|min:5|unique:coupons,coupon_code',
            'amount' => 'required|string',
            'amount_type' => 'required|string',
            'exipry_date' => 'required|string',
            'status' => 'nullable|integer',
        ]);

        $request['status'] = $request->status ?? 0;

        Coupon::create($request->except('_token'));

        return redirect()->back()->with('success', 'Coupon created success !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}

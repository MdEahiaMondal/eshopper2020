<?php

namespace App\Http\Controllers\Backend;

use App\Currencie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CurrencieController extends Controller
{

    public function index()
    {
        $currencies = Currencie::all();
       return view('backend.currency.index', compact('currencies'));
    }


    public function create()
    {
        return view('backend.currency.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|unique:currencies,currency_code',
            'exchange_rate' => 'required',
        ]);
        Currencie::create($request->all());
        return redirect()->back()->with('success', 'Currency Create Success !');
    }


    public function show(Currencie $currencie)
    {
        //
    }


    public function edit(Currencie $currencie)
    {
       return view('backend.currency.edit', compact('currencie'));
    }


    public function update(Request $request, Currencie $currencie)
    {
        $request->validate([
            'currency_code' => 'required|unique:currencies,currency_code,'.$currencie->id,
            'exchange_rate' => 'required',
        ]);
        $currencie->update($request->all());
        return redirect()->back()->with('success', 'Updated  Success !');
    }


    public function destroy(Currencie $currencie)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsleterSubscriber extends Controller
{


    public function index()
    {
        $newsleter_subscribers = \App\NewsleterSubscriber::all();
        return view('backend.subscriber.index', compact('newsleter_subscribers'));
    }

    public function destroy(\App\NewsleterSubscriber $newsleterSubscriber)
    {
        $newsleterSubscriber->delete();
        return redirect()->back()->with('success', 'Subscriber deleted success !');
    }

    public function statusActiveUnactive()
    {

    }


}

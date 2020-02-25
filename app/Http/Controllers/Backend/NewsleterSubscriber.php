<?php

namespace App\Http\Controllers\Backend;

use App\Exports\SubscriberExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function show()
    {

    }
    public function statusActiveUnactive()
    {

    }


    public function subscriberExcelFile()
    {
        return Excel::download(new SubscriberExport, 'subscribe.xlsx');
    }


}

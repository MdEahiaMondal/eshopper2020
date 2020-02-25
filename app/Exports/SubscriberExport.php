<?php

namespace App\Exports;

use App\NewsleterSubscriber;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $subscriber = \App\NewsleterSubscriber::select('id', 'email', 'created_at')->latest()->get(); // we can do modefy collection to excel
//        return NewsleterSubscriber::all();
        return  $subscriber;
    }
}

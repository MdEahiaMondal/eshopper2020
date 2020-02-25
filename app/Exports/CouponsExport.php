<?php

namespace App\Exports;

use App\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Coupon::select('coupon_code','amount', 'amount_type','exipry_date', 'created_at')->get();
    }


    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Coupon Code',
            'Amount',
            'Amount Type',
            'Exipry Date',
            'Create At',
        ];
    }

}

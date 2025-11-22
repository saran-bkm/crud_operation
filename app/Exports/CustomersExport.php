<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('name', 'email', 'phone')->get();
    }

    /**
     * Heading row
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
        ];
    }
}

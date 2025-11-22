<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Item::updateOrCreate(
            ['sku' => $row['sku']],  
            [
                'name'  => $row['name'],
                'price' => $row['price'],
                'stock' => $row['stock'],
            ]
        );
    }
}

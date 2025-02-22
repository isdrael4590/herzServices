<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Machine\Entities\Category;
use Modules\Machine\Entities\Machine;

class MachineImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {



        foreach ($rows as $row) {

            $Category_id = Category::where("category_name", $row['area'])->get()->first();
            Machine::create([
                'category_id' => $Category_id->id,
               // 'product_name' => $row['product_name'],
                
            ]);
        }
    }
}

<?php

namespace App\Imports;

use Modules\Machine\Entities\Category;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Informat\Entities\Area;

class CategoryImport implements ToCollection
{
    // This function is called when the data is imported
    public function collection(Collection $rows)
    {

        // Remove the header row (optional, if needed)
        $rows = $rows->skip(1);  // Skip the first row if it's a header row

        // Filter out duplicates based on the 'name' column (assuming 'name' is the column to check for uniqueness)
        $uniqueRows = $rows->unique(function ($row) {
            return $row[5]; // The 'name' column value
        });

        // Store the unique rows in the database
        foreach ($uniqueRows as $row) {
            // Assuming you have 'name' and 'other_column' in the Excel file
            $category_code = "CA_" . str_pad($row[0], 2, '0', STR_PAD_LEFT);
            Category::updateOrCreate(

                ['category_name' => $row[5]], // Find by name to avoid duplicates

                ['category_code' => $category_code]
            );

            $Area_code = "Area_" . str_pad($row[0], 2, '0', STR_PAD_LEFT);
            Area::updateOrCreate(

                ['area_name' => $row[5]], // Find by name to avoid duplicates
                [
                    'area_code' => $Area_code,
                    'area_responsable' => $row[5],
                    'area_piso' => $row[5]
                ],

            );
        }
    }
}

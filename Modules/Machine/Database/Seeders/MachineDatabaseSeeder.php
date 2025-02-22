<?php

namespace Modules\Machine\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Machine\Entities\Category;
use Modules\Machine\Entities\Machine;

class MachineDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Category::create([
            'category_code' => 'CA_01',
            'category_name' => 'ANESTESIA'
        ]);

       Machine::create([
        'category_id' => '1',
            'DescActivo' => 'MAQUINA DE ANESTESIA FABIUS PLUS XL',
            'IDActivo'  => 'ASJL-0067',
            'DescMarca'  => 'DRAGER',
            'DescModelo'  => 'FABIUS PLUS XL',
            'DescCliente'  => 'BECERRA NARANJO CELIA DARNILA',
            'date_manufacture'  => '2018',
            'machine_note' => 'prueba',
            'machine_barcode_symbology' => 'C128'
        ]
        );
      
   

    }
}
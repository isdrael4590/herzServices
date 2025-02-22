<?php

namespace Modules\Informat\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Informat\Entities\Area;
use Modules\Informat\Entities\Institute;
use Modules\Informat\Entities\Machine;
use Modules\Informat\Entities\Unit;

class InformatDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Institute::create([
            'institute_code' => 'Inst_01',
            'institute_name' => 'Hospital de Especialidades de FF.AA N°1',
            'institute_address' => 'Av. Gran Colombia &, Quito 170136',
            'institute_area' => 'Central Esterilización',
            'institute_city' => 'Quito',
            'institute_country' => 'Ecuador'
        ]);
        Area::create([
            'area_code' => 'Area_01',
            'area_name' => 'Ingenieria Alem ',
            'area_responsable' => 'FJacome',
            'area_piso' => 'P3',
            
        ]);


        Unit::create([
            'name' => 'Unidad',
            'short_name' => 'Un',
     
        ]);
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Modules\User\Database\Seeders\PermissionsTableSeeder;
use Modules\Informat\Database\Seeders\InformatDatabaseSeeder;
use Modules\Machine\Database\Seeders\MachineDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(SuperUserSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(MachineDatabaseSeeder::class);
        $this->call(InformatDatabaseSeeder::class);
    }
}

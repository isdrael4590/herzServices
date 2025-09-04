<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name' => 'Herz Group',
            'company_email' => 'herzoftgroup@gmail.com',
            'company_phone' => '0962076488',
            'notification_email' => 'herzgroup@gmail.com',
            'footer_text' => 'Herz Group 2024 || Developed by <strong><a target="_blank" href=#">Israel Jácome</a></strong>',
            'company_address' => 'Ecuador, Santiago de Pillaro'
        ]);
    }
}

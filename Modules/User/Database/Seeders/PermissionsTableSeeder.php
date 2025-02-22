<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //User Mangement
            'edit_own_profile',
            'access_user_management',
            'show_Dashboard',
            'access_user',
            'access_reports',
            'access_roles',
            'access_machines',
            'access_machine_categories',
            'add_image',
            'print_barcodes',
            'access_settings',
            'access_brands',
            'access_informats',
            'access_informat_areas',
            'access_informat_institutes',
            'access_admin',

// roles

            'create_roles',
            'show_roles',
            'edit_roles',
            'delete_roles',
            'print_roles',


            //  User

            'create',
            'show',
            'edit',
            'delete',
            'print',


            // 




        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create([
            'name' => 'Admin'
        ]);

        $role->givePermissionTo($permissions);
        $role->revokePermissionTo('access_user_management');
    }
}

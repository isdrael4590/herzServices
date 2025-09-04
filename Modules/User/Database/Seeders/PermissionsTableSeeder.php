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
            'create_user_management',
            'edit_user_management',
            'delete_user_management',



            //roles
            'access_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',


            //Settings
            'access_settings',
            //Units
            'access_informats_units',





        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $adminrole = Role::create([
            'name' => 'Admin'
        ]);

        $adminrole->givePermissionTo($permissions);

        $supervisorRole = Role::create(['name' => 'GerenteZonal']);
        $supervisorPermission = [
            //User Mangement
            'edit_own_profile',
            'access_user_management',
            'create_user_management',
            'edit_user_management',





        ];
        $supervisorRole->givePermissionTo($supervisorPermission);


        $usuarioRole = Role::create(['name' => 'GerenteNacional']);
        $usuarioPermission = [

            'edit_own_profile',
            'access_user_management',
            'create_user_management',
            'edit_user_management',




        ];
        $usuarioRole->givePermissionTo($usuarioPermission);
        
    }
}

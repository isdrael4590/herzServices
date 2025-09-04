<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

require_once __DIR__ . '/../../utils/docker_secrets.php';

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'herzoftgroup@gmail.com',
            'password' => Hash::make(docker_secret('/run/secrets/admin_password')),
            'is_active' => 1
        ]);

        $superAdmin = Role::create([
            'name' => 'Super Admin'
        ]);

        $superAdmin->givePermissionTo(Permission::all());
        $user->assignRole($superAdmin);
    }
}

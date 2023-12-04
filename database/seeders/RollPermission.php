<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RollPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);


        $permissions = [

            ['name' => 'writer '],
            ['name' => 'user '],
            ['name' => 'admin '],

        ];

        foreach ($permissions as $iteam) {
            Permission::create($iteam);
        }

        $role->syncPermissions(Permission::all());
        //$permission->syncRoles($roles);
        $user = User::first();
        $user->assignRole($role);
    }
}

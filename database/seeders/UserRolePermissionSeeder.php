<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_value_user = [
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('admin123'),
            'remember_token' => Str::random(10),
            
        ];

        $staff = User::create(array_merge([
            'email' => "staff@gmail.com",
            'name' => "Staff"
        ], $default_value_user));

        $spv = User::create(array_merge([
            'email' => "spv@gmail.com",
            'name' => "SPV"
        ], $default_value_user));

        $manager = User::create(array_merge([
            'email' => "manager@gmail.com",
            'name' => "Manager"
        ], $default_value_user));

        $it = User::create(array_merge([
            'email' => "it@gmail.com",
            'name' => 'IT'
        ], $default_value_user));

        $role_staff = Role::create(['name' => 'staff']);
        $role_spv = Role::create(['name' => 'spv']);
        $role_manager = Role::create(['name' => 'manager']);
        $role_it = Role::create(['name' => 'it']);

        $permission = Permission::create(['name' => 'read role']);
        $permission = Permission::create(['name' => 'create role']);
        $permission = Permission::create(['name' => 'update role']);
        $permission = Permission::create(['name' => 'delete role']);

        $role_it->givePermissionTo('read role');
        $role_it->givePermissionTo('create role');
        $role_it->givePermissionTo('update role');
        $role_it->givePermissionTo('delete role');

        $staff->assignRole('staff');
        $staff->assignRole('spv');
        $spv->assignRole('spv');
        $manager->assignRole('manager');
        $it->assignRole('it');
    }
}

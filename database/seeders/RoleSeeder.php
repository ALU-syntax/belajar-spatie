<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'ceo']);
        Role::create(['name' => 'publisher']);
        Role::create(['name' => 'administrator']);
    }
}

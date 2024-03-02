<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Konfigurasi\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** 
         * @var Menu $mm
         */
        $mm = Menu::create([
            'name' => 'konfigurasi',
            'url' => 'konfigurasi',
            'category' => 'MASTER DATA',
            'icon' => 'setting'
        ]);

        $mm->subMenus()->create(['name' => 'Menu', 'url' => $mm->url . '/menu', 'category' => $mm->category]);
    }
}

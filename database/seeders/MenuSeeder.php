<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Konfigurasi\Menu;
use App\Traits\HasMenuPermission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Cache::forget('menus');
        /** 
         * @var Menu $mm
         */
        $mm = Menu::firstOrCreate(['url' => 'konfigurasi'],['name' => 'Konfigurasi', 'category' => 'MASTER DATA','icon' => 'settings']);
        $this->attachMenuPermission($mm, ['read '], ['ceo']);
        
        $sm = $mm->subMenus()->create(['name' => 'Menu', 'url' => $mm->url . '/menu', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create ', 'read ', 'update ', 'delete ', 'sort '], ['ceo']);

        $sm = $mm->subMenus()->create(['name' => 'Role', 'url' => $mm->url . '/roles', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create ', 'read ', 'update ', 'delete ', 'sort '], ['ceo']);

        $sm = $mm->subMenus()->create(['name' => 'Permission', 'url' => $mm->url . '/permissions', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create ', 'read ', 'update ', 'delete '], ['ceo']);

        $sm = $mm->subMenus()->create(['name' => 'Akses Role', 'url' => $mm->url . '/akses-role', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, [ 'read ', 'update '], ['ceo']);

        $sm = $mm->subMenus()->create(['name' => 'Users', 'url' => $mm->url . '/users', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, null, ['ceo']);

        $mm = Menu::firstOrCreate(['url' => 'master-data'],['name' => 'Master Data', 'category' => 'MASTER DATA','icon' => 'book']);
        $this->attachMenuPermission($mm, ['read '], ['ceo']);
        
        $sm = $mm->subMenus()->create(['name' => 'Tags', 'url' => $mm->url . '/tags', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, null, ['ceo']);

        $mm = Menu::firstOrCreate(['url' => 'articles'],['name' => 'Articles', 'category' => 'CONTENT','icon' => 'book']);
        $this->attachMenuPermission($mm, ['read '], ['ceo']);

        
    }
}

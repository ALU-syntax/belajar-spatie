<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Konfigurasi\Menu;
use App\Http\Controllers\Controller;
use App\DataTables\Konfigurasi\RoleDataTable;

class AksesRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('pages.konfigurasi.akses-role');
    }

    /**
     * Show data
     */
    public function show(Role $role){

    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $menus = Menu::with('permissions', 'subMenus.permissions')->whereNull('main_menu_id')->get();
        return view('pages.konfigurasi.akses-role-form',[
            'data' => $role,
            'action' => route('konfigurasi.akses-role.update', $role->id),
            'menus' => $menus
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        return responseSuccess(true);
    }
}

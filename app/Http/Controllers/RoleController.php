<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('can:create role')->only('create');
    }
    public function index(){
        $this->authorize('read role');  

        return 'role page';
    }

    public function create(){
        return 'role create page';
    }
}

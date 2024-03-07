<?php

use App\Models\Konfigurasi\Menu;
use Illuminate\Support\Facades\Cache;

if(!function_exists('responseError')){
    function responseError(\Exception | string $th)
    {
        $message = 'Terjadi kesalahan, silahkan coba beberapa saat lagi';
        if($th instanceof \Exception){
            if(config('app.debug')){
                $message = $th->getMessage();
                $message .= ' in line ' . $th->getLine() . ' at ' . $th->getFile();
                $data = $th->getTrace();
            }
        }else{
            $message = $th; 
        }
            
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data ?? null
        ], 500);
    }
}

if(!function_exists('responseSuccess')){
    function responseSuccess($isEdit = false){

        return response()->json([
            'status' => 'success',
            'message' => $isEdit ? 'Update data Successfully' : 'Create data Successfully',
        ]);

    }
}

if(!function_exists('menus')){
    function menus(){

        if(!Cache::has('menus')){
            $menus = Menu::with(['subMenus' => function($query){
                return $query->orderBy('orders');
            }])->whereNull('main_menu_id')
            ->active()
            ->orderBy('orders')
            ->get()
            ->groupBy("category");
            Cache::forever('menus', $menus);
        }else{
            $menus = Cache::get('menus');
        }

        return $menus;
    }
}
<?php

use App\Models\Menu;
use App\Models\RolePermission;
use App\Models\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Menu::orderBy('sequence_no', 'asc')->get();
    }
}

if (!function_exists('getMenusWithPermissions')) {
    function getMenusWithPermissions($menu_id,$action)
    {
        
        $hasPermission = DB::table('tbl_role_permissions')
        ->where('role_id', Session::get('role_id'))
        ->where('menu_id', $menu_id)
        ->where($action, 1)
        ->exists();


        return $hasPermission;
    }
}
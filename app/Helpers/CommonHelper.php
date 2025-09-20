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

if (!function_exists('getSubMenus')) {
    function getSubMenus($menu_id)
    {
        return Menu::where('parent_id', $menu_id)->get();
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

if (!function_exists('checkvendorverify')) {
    function checkvendorverify()
    {
        
        $vid=session('vid');

        $vendors=DB::table('tbl_vendors')->where('id', $vid)->first();

       if($vendors->is_rera_certificate_verified==0 || $vendors->is_pancard_verified==0 || $vendors->is_real_estate_certificate_verified==0){
                       
                       return true;
                   }


        // return $vendors;
    }
}
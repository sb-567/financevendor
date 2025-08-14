<?php

use App\Models\Menu;
use App\Models\RolePermission;
use App\Models\Auth;
// use Illuminate\Support\Facades\Auth;

if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Menu::orderBy('sequence_no', 'asc')->get();
    }
}

function getUserMenusWithPermissions($role_id)
{
    

    return RolePermission::with('menu')
        ->where('role_id', $role_id)
        ->get();
}
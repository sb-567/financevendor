<?php

use App\Models\RolePermission;
use App\Models\Menu;

function hasPermission($menuId, $action)
{
    $roleId = auth()->user()->role_id;
    $perm = RolePermission::where('role_id', $roleId)
        ->where('menu_id', $menuId)
        ->first();

    return $perm && $perm->$action;
}




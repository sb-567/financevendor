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

if (!function_exists('getSubMenusbyslug')) {
    function getSubMenusbyslug($menu_id)
    {
        return Menu::where('route_name', $menu_id)->first();
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
        
        // if(session()->get('vid')==""){
        //     return false;
        // }

        $vid=session()->get('vid');

        $vendors=DB::table('tbl_vendors')->where('id', $vid)->first();

       if($vendors->is_rera_certificate_verified==0 || $vendors->is_pancard_verified==0 || $vendors->is_real_estate_certificate_verified==0){
                       
                       return true;
                   }


        // return $vendors;
    }
}

if (!function_exists('checkvendorverify2')) {
    function checkvendorverify2()
    {
        $vid = session('vid');

        if (!$vid) {
            return null;
        }

        $vendor = DB::table('tbl_vendors')->where('id', $vid)->first();

        if (
            $vendor &&
            (
                $vendor->is_rera_certificate_verified == 0 ||
                $vendor->is_pancard_verified == 0 ||
                $vendor->is_real_estate_certificate_verified == 0
            )
        ) {
            // prevent redirect loop
            if (!request()->routeIs('vendors.profile')) {
                return redirect()->route('vendors.profile');
            }
        }

        return null;
    }
}

if (!function_exists('getcurrentsubcription')) {

function getcurrentsubcription()
{
    $agent_id = session('vid');
    $today = date('Y-m-d');

    if (!$agent_id) {
        return null;
    }

    $plans = DB::table('tbl_orders')
        ->select(
            'tbl_orders.*',
            'tbl_subscription.title',
            'tbl_subscription.subscription_type',
            'tbl_subscription.no_of_leads'
        )
        ->leftJoin('tbl_subscription', 'tbl_subscription.id', '=', 'tbl_orders.subscription_id')
        ->where('tbl_orders.agent_id', $agent_id)
        ->orderBy('tbl_orders.id','ASC')
        ->get();

    foreach ($plans as $plan) {

        // DATE PLAN
        if ($plan->subscription_type == 1) {

            if ($today <= date('Y-m-d',strtotime($plan->end_date))) {
                return $plan;
            }

        }

        // LEAD PLAN
        if ($plan->subscription_type == 2) {
        //     echo $remainingLeads = $plan->no_of_lead_get - $plan->used_no_of_lead;
        // die;
            if ($plan->used_no_of_lead > 0) {
                return $plan;
            }
        }

    }

    return null;
}

}



if (!function_exists('getagentprofiledata')) {
    function getagentprofiledata()
    {
        $vid = session('vid');

        if (!$vid) {
            return null;
        }

       $order = DB::table('tbl_vendors')->where('id', $vid)->first();

        return $order;
    }
}


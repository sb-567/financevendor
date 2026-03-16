<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $vendorId = session('vid');

        // Current month leads
        $currentLeads = DB::table('tbl_leads')
            ->where('vendor_id', $vendorId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Previous month leads
        $previousLeads = DB::table('tbl_leads')
            ->where('vendor_id', $vendorId)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Current month properties
        $currentProperties = DB::table('tbl_properties')
            ->where('vendor_id', $vendorId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Previous month properties
        $previousProperties = DB::table('tbl_properties')
            ->where('vendor_id', $vendorId)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $data['no_of_lead'] = $currentLeads;
        $data['no_of_property_listing'] = $currentProperties;

        $data['leadPercentage'] = $this->calcPercentage($currentLeads, $previousLeads);
        $data['propertyPercentage'] = $this->calcPercentage($currentProperties, $previousProperties);

        return view('vendor.dashboard', $data);
    }

    function calcPercentage($current, $previous)
    {
        if ($previous > 0) {
            return round((($current - $previous) / $previous) * 100, 2);
        }
        return $current > 0 ? 100 : 0;
    }

}

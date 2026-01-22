<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Vendors;

class DashboardController extends Controller
{
    

    public function index(){

        $data['allagents'] = $this->getAgentsCount('2');
        $data['verifiedagent'] = $this->getAgentsCount('1');
        $data['newsignup'] = $this->getAgentsCount('1');

        $currentCount  = Vendors::count(); // or filtered count
$previousCount = Vendors::whereDate('created_at', '<', now()->subMonth())->count();

if ($previousCount > 0) {
    $percentageChange = (($currentCount - $previousCount) / $previousCount) * 100;
} else {
    $percentageChange = 100;
}

$percentageChange = number_format($percentageChange, 2);
        $data['percentageChange'] = $percentageChange;
        $data['currentCount'] = $currentCount;


        return view('admin.dashboard',$data);
    }

    public function getAgentsCount($type){
         $query  = DB::table(table: 'tbl_vendors');
         if($type != '2'){
                    $query->where('status', $type);
         }
                    $agentscount = $query->count();
        return $agentscount;
    }
}

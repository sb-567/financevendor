<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Vendors;
use App\Models\Lead;
use Carbon\Carbon;

class DashboardController extends Controller
{
    

    public function index(){

        $data['allagents'] = $this->getAgentsCount('2');
        $data['verifiedagent'] = $this->getAgentsCount('1');
        $data['newsignup'] = $this->getAgentsCount('0');

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



        $currentVerified = Vendors::where('status', 1)->count();

        $previousVerified = Vendors::where('status', 1)
            ->whereDate('created_at', '<', now()->subMonth())
            ->count();

        if ($previousVerified > 0) {
            $verifiedPercentage = (($currentVerified - $previousVerified) / $previousVerified) * 100;
        } else {
            $verifiedPercentage = 0;
        }

        $verifiedPercentage = round($verifiedPercentage, 2);

          
        $data['currentVerifiedCount'] = $currentVerified;
        $data['verifiedPercentageCount'] = $verifiedPercentage;




        $currentNewSignup = Vendors::where('status', 0)->count();

        $previousNewSignup = Vendors::where('status', 0)
            ->whereDate('created_at', '<', now()->subMonth())
            ->count();

        if ($previousNewSignup > 0) {
            $newSignupPercentage = (($currentNewSignup - $previousNewSignup) / $previousNewSignup) * 100;
        } else {
            $newSignupPercentage = 0;
        }

        $newSignupPercentage = round($newSignupPercentage, 2);


        $data['currentNewSignupCount'] = $currentNewSignup;
        $data['newSignupPercentageCount'] = $newSignupPercentage;


        $data['totalleads'] = $this->getleadcount('');
        $data['thismonthlead'] = $this->getleadcount(2);
        $data['thisweeklead'] = $this->getleadcount(3);
        $data['todaylead'] = $this->getleadcount(4);



        /* ================= TOTAL ================= */
        $totalCurrent = Lead::count();
        $totalPrevious = Lead::whereDate('created_at', '<', now()->subMonth())->count();

        /* ================= THIS MONTH ================= */
        $monthCurrent = Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $monthPrevious = Lead::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        /* ================= THIS WEEK ================= */
        $weekCurrent = Lead::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $weekPrevious = Lead::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->count();

        /* ================= TODAY ================= */
        $todayCurrent = Lead::whereDate('created_at', Carbon::today())->count();
        $todayPrevious = Lead::whereDate('created_at', Carbon::yesterday())->count();

        /* ================= PERCENTAGE FUNCTION ================= */
        $data['totalPercentage'] = $this->calcPercentage($totalCurrent, $totalPrevious);
        $data['monthPercentage'] = $this->calcPercentage($monthCurrent, $monthPrevious);
        $data['weekPercentage'] = $this->calcPercentage($weekCurrent, $weekPrevious);
        $data['todayPercentage'] = $this->calcPercentage($todayCurrent, $todayPrevious);
        

        return view('admin.dashboard',$data);
    }

    function calcPercentage($current, $previous) {
            if ($previous > 0) {
                return round((($current - $previous) / $previous) * 100, 2);
            }
            return 0;
        }





    public function getAgentsCount($type){
         $query  = DB::table(table: 'tbl_vendors');
         if($type != '2'){
                    $query->where('status', $type);
         }
                    $agentscount = $query->count();
        return $agentscount;
    }

    public function getleadcount($type){
        $query  = DB::table(table: 'tbl_leads');
        if($type == 2){
            $query->whereMonth('created_at', '=', date('m'));
            $query->whereYear('created_at', '=', date('Y'));
        }elseif($type == 3){
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        }elseif($type == 4){
            $query->whereDate('created_at', '=', date('Y-m-d'));
        }
        $leadcount = $query->count();
    
       return $leadcount;

    }


}

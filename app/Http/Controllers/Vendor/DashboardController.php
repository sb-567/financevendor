<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index(){

         $data['verified_user']=DB::table('tbl_vendors')->where('status',1)->first();

        return view('vendor.dashboard',$data);
    }
}

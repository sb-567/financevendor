<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session; 

class SubscribeController extends Controller
{
    
    public function index(){
        $data['title']="Subscribtion Plan";
        $data['subscribe']= DB::table('tbl_subscription')->get();
         
        return view('vendor/subscribe/subscribe',$data);
    }





}

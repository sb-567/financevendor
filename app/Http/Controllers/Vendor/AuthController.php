<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use App\Models\Vendors;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request){
        // Check if the user is already logged in
        if ($request->session()->has('uid')) {
            return redirect('dashboard'); // Redirect to dashboard if session is set
        }

        return view('vendor.auth');

    }

    public function vlogin(Request $request)
    {   


         $username = $request->username;
         $password = $request->password;
   
        $user = Vendors::where(function($query) use ($username) {
            $query->where('name', $username)
              ->orWhere('email', $username);
        })->first();

        if ($user && Hash::check($password, $user->password)) {
            
            $request->session()->put('vendor_id', $user->id);

            $otp = 1234; // Generate a random 4-digit OTP
            // $otp = rand(1000, 9999); // Generate a random 4-digit OTP
           
            Vendors::where('id', $user->id)->update(['otp' => $otp]); 
            

            // $request->session()->put('role_id', $user->role_id);
            return redirect()->route('vendors.verify');
            
        } else {
            
            session()->flash('error', 'Username or password does not match');
            return redirect()->route('vendors.login');
            
        }
    }
    
    public function verify(Request $request)
    {
        
         if (!$request->session()->has('vendor_id')) {
             return redirect()->route('vendors.login');
        }

        return view('vendor.verify');
    }
    
    public function verifyotp(Request $request)
    {   
        // echo "ef";
        // die;
        if (!$request->session()->has('vendor_id')) {
            return redirect()->route('vendors.login');
        }

         $uid = session('vendor_id');
         $otp = $request->otp1. $request->otp2 . $request->otp3 . $request->otp4;
   
        $user = Vendors::where('id', $uid)->first();

        if ($user->otp==$otp) {
            
            $request->session()->put('vid', $user->id);
            // $request->session()->put('role_id', $user->role_id);

            $request->session()->forget('vendor_id');
            
             return redirect()->route('vendors.dashboard');
        } else {
            
            session()->flash('error', 'OTP does not match');
            return redirect()->route('vendors.verify');
        }
    }

    
    public function logout(Request $request)
    {
        $request->session()->forget('vid');
        // $request->session()->forget('role_id');
        return redirect()->route('vendors.login');
    }

    public function vregister(Request $request){
        return view('vendor.register');
    }

}

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

    public function login(Request $request)
    {
         $username = $request->username;
         $password = $request->password;
   
        $user = Vendors::where(function($query) use ($username) {
            $query->where('username', $username)
              ->orWhere('email', $username);
        })->first();

        if ($user && Hash::check($password, $user->password)) {
            
            $request->session()->put('user_id', $user->id);

            $otp = 1234; // Generate a random 4-digit OTP
            // $otp = rand(1000, 9999); // Generate a random 4-digit OTP
           
            Vendors::where('id', $user->id)->update(['otp' => $otp]); 
            

            // $request->session()->put('role_id', $user->role_id);
            return redirect('verify');
        } else {
            
            session()->flash('error', 'Username or password does not match');
            return redirect('/');
        }
    }
    
    public function verify(Request $request)
    {
        
         if (!$request->session()->has('user_id')) {
            return redirect('/');
        }

        return view('vendor.verify');
    }
    
    public function verifyotp(Request $request)
    {   
        // echo "ef";
        // die;
        if (!$request->session()->has('user_id')) {
            return redirect('/');
        }

         $uid = session('user_id');
         $otp = $request->otp1. $request->otp2 . $request->otp3 . $request->otp4;
   
        $user = Vendors::where('id', $uid)->first();

        if ($user->otp==$otp) {
            
            $request->session()->put('uid', $user->id);
            $request->session()->put('role_id', $user->role_id);

            $request->session()->forget('user_id');
            return redirect('dashboard');
        } else {
            
            session()->flash('error', 'OTP does not match');
            return redirect('/');
        }
    }

    
    public function logout(Request $request)
    {
        $request->session()->forget('uid');
        $request->session()->forget('role_id');
        return redirect('/');
    }

}

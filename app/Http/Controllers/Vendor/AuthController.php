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

        // if(checkvendorverify()){
        //     session()->flash('error', 'Please update your profile documents for verification.');
        //     return redirect()->route('vendors.profile');
        // }else{
        if ($request->session()->has('vid')) {
            return redirect('vendors/dashboard'); // Redirect to dashboard if session is set
        }

        // echo $request->session()->get('vendor_id');
        return view('vendor.auth');

    }

    public function vlogin(Request $request)
    {   


         $username = $request->username;
         $password = $request->password;
   
        $user = Vendors::where(function($query) use ($username) {
            $query->where('phone', $username)
              ->orWhere('email', $username);
        })->first();

        if ($user && Hash::check($password, $user->password)) {
            
            // if($user->status==0){
            //     session()->flash('error', 'Your account is inactive. Please contact support.');
            //     return redirect()->route('vendors.login');
            // }

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

            $vid=session('vid');

            $vendors=DB::table('tbl_vendors')->where('id', $vid)->first();

            if($vendors->is_rera_certificate_verified==0 || $vendors->is_pancard_verified==0 || $vendors->is_real_estate_certificate_verified==0){
                session()->flash('error', 'Please update your profile documents for verification.');
                return redirect()->route('vendors.profile');
            }            
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

    public function vregistersave(Request $request){
        
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:tbl_vendors',
        //     'phone' => 'required|string|max:15|unique:tbl_vendors',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     session()->flash('error', 'Please correct the errors below.');
        //     return redirect()->back()
        //     ->withErrors($validator)
        //     ->withInput();
        // }



        $rera_certificate = null;
        $real_estate_certificate = null;
        $pancard = null;

        if ($request->hasFile('rera_certificate')) {
            $file = $request->file('rera_certificate');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $rera_certificate = time() . '_rera.webp';
            $path = public_path('uploads/vendors/' . $rera_certificate);

            // Convert and save to webp
            imagewebp($image, $path, 80); // 80 = quality
            imagedestroy($image);
        } else {
            $rera_certificate = $request->input('old_rera_certificate');
        }

        if ($request->hasFile('real_estate_certificate')) {
            $file = $request->file('real_estate_certificate');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $real_estate_certificate = time() . '_realestate.webp';
            $path = public_path('uploads/vendors/' . $real_estate_certificate);

            imagewebp($image, $path, 80);
            imagedestroy($image);
        } else {
            $real_estate_certificate = $request->input('old_real_estate_certificate');
        }

        if ($request->hasFile('pancard')) {
            $file = $request->file('pancard');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $pancard = time() . '_pancard.webp';
            $path = public_path('uploads/vendors/' . $pancard);

            imagewebp($image, $path, 80);
            imagedestroy($image);
        } else {
            $pancard = $request->input('old_pancard');
        }

        
    
            DB::table('tbl_vendors')->insert([
                'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->password),
                'area' => $request->input('area'),
                'pincode' => $request->input('pincode'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'landmark' => $request->input('landmark'),
                'rera_certificate' => $rera_certificate,
                'pancard' => $pancard,
                'real_estate_certificate' => $real_estate_certificate,
                'is_rera_certificate_verified' => $rera_certificate ? 1 : 0,
                'is_pancard_verified' => $pancard ? 1 : 0,
                'is_real_estate_certificate_verified' => $real_estate_certificate ? 1 : 0,
            ]);

        

        session()->flash('success', 'Registration successful. Please log in.');
        return redirect()->route('vendors.login');
    }

}

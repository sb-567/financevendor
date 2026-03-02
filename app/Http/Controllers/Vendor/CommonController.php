<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
      public function profile(){
        $data['title']="Profile";
        // echo session()->get('vid');
        // die;
        
          $vendor_id = session('vid');
        $data['fetched']=DB::table('tbl_vendors')->where('id',$vendor_id)->first();
         
        return view('vendor/profile/profile',$data);
    }

    public function changepassword(Request $request){

        
            $vendor_id = session('vid');
            $old_password = request('old_password');
            $new_password = request('new_password');
            $confirm_password = request('confirm_password');

            $vendor = DB::table('tbl_vendors')->where('id', $vendor_id)->first();

            if (!$vendor || $vendor->password !== $old_password) {
            session()->flash('error', 'Old password is incorrect.');
            return redirect()->back();
            }

            if ($new_password !== $confirm_password) {
            session()->flash('error', 'New password and confirm password do not match.');
            return redirect()->back();
            }

            DB::table('tbl_vendors')->where('id', $vendor_id)->update([
            'password' => $new_password
            ]);

            session()->flash('success', 'Password changed successfully.');
            return redirect()->back();
        

    }

    public function updateprofile(Request $request){

        
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

        
    
            $vendor_id = session('vid');
            $updateData = [
                // 'name' => $request->input('name'),
                // 'phone' => $request->input('mobile'),
                // 'email' => $request->input('email'),
                // 'area' => $request->input('area'),
                // 'pincode' => $request->input('pincode'),
                // 'city' => $request->input('city'),
                // 'state' => $request->input('state'),
                // 'landmark' => $request->input('landmark'),


                'name' => $request->input('name'),
                'agent_business_name' => $request->input('agent_business_name'),
                'business_type' => $request->input('business_type'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'area' => $request->input('area'),
                'zone_side' => $request->input('sidezone'),
                'parent_area' => $request->input('parentarea'),
                'micro_area_galli' => $request->input('micro_area_galli'),
                'service_area_covered' => $request->input('service_area_covered'),
                'property_type' => $request->input('property_type'),
                'transaction_type' => $request->input('transaction_type'),
                'landmark' => $request->input('landmark'),
                'pincode' => $request->input('pincode'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'signup_source' =>$request->input('signup_source'),
                


                'rera_certificate' => $rera_certificate,
                'pancard' => $pancard,
                'real_estate_certificate' => $real_estate_certificate,
                'is_rera_certificate_verified' => $rera_certificate ? 1 : 0,
                'is_pancard_verified' => $pancard ? 1 : 0,
                'is_real_estate_certificate_verified' => $real_estate_certificate ? 1 : 0,
            ];

            // $query = DB::table('tbl_vendors')->where('id', $vendor_id)->toSql();
            // print_r($query);
            // print_r($updateData);

            DB::table('tbl_vendors')->where('id', $vendor_id)->update($updateData);

        

        session()->flash('success', 'Profile successfully Updated');
        return redirect()->route('vendors.profile');


    }


}

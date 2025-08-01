<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    

    public function customer_login(Request $request)
    {
         $mobile = $request->mobile;

         $user = DB::table('tbl_users')->where('mobile', $mobile)->first(); 

        //  $otp = rand(1111,9999);
         $otp = 1111;
        //  print_r($user);
        //  die; 


        $message = "Use OTP $otp to log into your account. Do not share the OTP or your number with anyone including Events Khachrod wale personnel. Apna Khachrod LLP";
        // $encodedMessage = urlencode($message);

        $url = "https://sms.hitechsms.com/app/smsapi/index.php";
        
        $response = Http::get($url, [
            'key'         => '567F0CFE51C186',
            'campaign'    => '0',
            'routeid'     => '13',
            'type'        => 'text',
            'contacts'    => $mobile,
            'senderid'    => 'APNKUH',
            'msg'         => $message,
            'template_id' => '1707174421057947118',
        ]);
        

        if ($user && $user->mobile > 0) {   
            
           
          $update_otp = DB::table('tbl_users')->where('mobile', $mobile)->update(['otp' => $otp]); 
        
          $response = [
                'message'=>"Otp Sent to your Mobile Number. Please Verify And Continue..",
                'otp'=>$otp,
                'is_otp_verifiy'=>$user->is_otp_verifiy,
                'customer_id'=>$user->id,
                'mobile'=>$user->mobile,
            ];
        
            return response()->json($response, 200);
            
        } else {

            $inserted = DB::table('tbl_users')->insert([
                'mobile' => $mobile,
                'otp' => $otp,
                'is_otp_verifiy'=>0
            ]);
            
            if ($inserted) {
                
                $lastId = DB::getPdo()->lastInsertId();
                
                $user = DB::table('tbl_users')->where('id',$lastId)->first(); 
                 
                 
                $response = [
                    'mobile' => $mobile,
                    'otp' => $otp,
                    'message' => "Successfully Registered.. Please Verify.",
                    'customer_id'=>$user->id,
                    'is_otp_verifiy'=>$user->is_otp_verifiy,
                ];
                return response()->json($response, 200);

            } else {
                $response = [
                    'message' => "Registration failed. Please try again."
                ];
                return response()->json($response, 204);  
            }
            
            
        }
    }



    public function verify_otp(Request $request)
    {
         $mobile = $request->mobile;
         $otp = $request->otp;

         $user = DB::table('tbl_users')->where('mobile', $mobile)->first(); 

         if(!empty($user) && $user->otp == $otp){
             
             $user_fetch = DB::table('tbl_users')->where('mobile', $mobile)->first(); 
             
             $is_otp_verified = $user->is_otp_verifiy;
             


        $response = [
            'message'=>"Otp Successfully Verified..",
            'is_otp_verifiy'=>$user_fetch->is_otp_verifiy,
            'customer_id'=>$user_fetch->id,
            'mobile'=>$user_fetch->mobile,
        ];
        
            return response()->json($response, 200);
            
        } else {
            
            $response = [
                'message'=>"Wrong OTP.. Please Enter Right OTP",
            ];
            return response()->json($response, 204);
            
        }
    }

    public function resend_otp(Request $request)
    {
        $mobile = $request->mobile;

         $user = DB::table('tbl_users')->where('mobile', $mobile)->first(); 

         $otp = rand(1111,9999);
        //  print_r($user);
        //  die; 

        if ($user && $user->mobile > 0) {   
            
           

          $update_otp = DB::table('tbl_users')->where('mobile', $mobile)->update(['otp' => $otp]); 
        
          $response = [
            'message'=>"Otp Resend to your Mobile Number. Please Verify And Continue..",
            'otp'=>$otp,
            'is_otp_verifiy'=>$user->is_otp_verifiy,
            'customer_id'=>$user->id,
            'mobile'=>$user->mobile,
        ];
        
            return response()->json($response, 200);
            
        }
    }
    
    
    public function sign_up(Request $request)
    {

        // echo "Test"; die;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'state_id' => 'required|string',
            'district_id' => 'required|string',
            'subdistrict_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
            ], 422);
        }

        $insertData['name'] = $request->name;
        $insertData['mobile'] = $request->mobile;
        $insertData['latitude'] = $request->latitude;
        $insertData['longitude'] = $request->longitude;
        $insertData['state_id'] = $request->state_id;
        $insertData['district_id'] = $request->district_id;
        $insertData['subdistrict_id'] = $request->subdistrict_id;
        $insertData['is_otp_verifiy'] = 1;

       
        DB::table('tbl_users')->updateOrInsert(
            ['id' => $request->customer_id],
            $insertData
        );
        $lastId = DB::getPdo()->lastInsertId();
        // $insertedId = DB::table('tbl_users')->insertGetId($insertData);
        $response = [
            'message' => "Record Updated Successfully.",
            'status' => "200",
            'customer_id' => $request->customer_id,
        ];



        return response()->json($response, 200);
        
        

       
    }


     public function profile_fetch(Request $request)
    {

        // echo "Test"; die;
        $customer_id = $request->customer_id;
        
        if (!empty($customer_id)) {

                $user = DB::table('tbl_users')
                ->where('tbl_users.id', '=',$customer_id)
                ->where('tbl_users.status', '=',1)
                ->first();
        
        
            if (!empty($user)) {
                $response = [
                    'message' => "Profile Details..",
                    'user_details' => $user,
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'message' => "User Not Available",
                ];
                return response()->json($response, 404);
            }
        } else {
            $response = [
                'message' => "Customer ID is required",
            ];
            return response()->json($response, 400);
        }
        

       
    }

    



}

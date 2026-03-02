<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session; 
use Razorpay\Api\Api;

class SubscribeController extends Controller
{
    
    public function index(){
        // $data['title']="Subscribtion Plan";
        $data['title']="";
        $data['subscribe']= DB::table('tbl_subscription')->get();
         
        return view('vendor/subscribe/subscribe',$data);
    }

    public function getsubcriptiondetail(Request $request){


        $request->validate([
            'subscription_id' => 'required|integer'
        ]);

        $subscription = DB::table('tbl_subscription')->where('id','=',$request->subscription_id)->first();

        return response()->json([
            'amount' => $subscription->cross_price,
            'id' => $subscription->id
        ]);


    }

    public function createOrder(Request $request){



            // $subtotal=500;
            // $request->amount
        
       $api = new Api('rzp_test_S6thv6wjP1pgdq', 'Yrx4LZyGVqy31MJfsHjc0Eca');

        $orderData = [
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $request->amount * 100, // amount in paise
            'currency'        => 'INR'
        ];

        // print_r($orderData);

        // echo "in";
        // die;

        $order = $api->order->create($orderData);

        return response()->json([
            'id' => $order->id,
            'amount' => $order->amount
        ]);
        
    }


  

    public function paymentSuccess(Request $request)
    {
        $input = $request->all();

        // 1. Get your keys
        $api = new Api('rzp_test_S6thv6wjP1pgdq', 'Yrx4LZyGVqy31MJfsHjc0Eca');
        try {
            $attributes = [
                'razorpay_order_id'   => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature'  => $input['razorpay_signature'],
            ];

            $api->utility->verifyPaymentSignature($attributes);


            $this->proccessOrder($input['razorpay_order_id'], $input['razorpay_payment_id'], $input['razorpay_signature']);
            
            return redirect('/')->with('success', 'Payment successful! Thank you for your order.');



            // ✅ Signature verified, proceed with DB logic
            // Save payment to DB, mark order paid, etc.
            // return response()->json(['status' => 'Payment successful']);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            // ❌ Invalid Signature
            Log::error('Razorpay Signature Error: ' . $e->getMessage());
            // return response()->json(['status' => 'Payment failed', 'error' => $e->getMessage()], 400);

            return redirect('/')->with('error', 'Payment verification failed.');
        }

        // 2. Signature verification
        // $generatedSignature = hash_hmac('sha256', $input['razorpay_order_id'] . '|' . $input['razorpay_payment_id'], env('RAZORPAY_SECRET'));

        // if ($generatedSignature === $input['razorpay_signature']) {
            // Payment is valid
            
            // ✅ Save payment info into database (example)
            // Payment::create([
            //     'payment_id' => $input['razorpay_payment_id'],
            //     'order_id' => $input['razorpay_order_id'],
            //     'status' => 'success'
            // ]);

            

            // return response()->json(['success' => true]);
        // } else {
        //     // 🛑 Invalid payment - maybe fraud
        //     // Log::error('Razorpay Payment Failed - Signature Mismatch', $input);
        //     // return response()->json(['success' => false]);

        //     return redirect('/')->with('error', 'Payment verification failed.');
        // }
    }


    public function proccessOrder($order_id, $payment_id, $signature)
    {   
    
    
    $orderData = [
        'student_id' => $sid,
        'order_number' => $order_id,
        'payment_id' => $payment_id,
        'signature' => $signature,
        'amount' => $subtotal,
        'coupon_type'=> $coupon ? $coupon->coupon_type : null,
        'coupon_value'=> $coupon ? $coupon->coupon_value : null,
        'status' => 1,
        'vendor_id' => session()->get('refer_id') ?? null,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $order_id=DB::table('tbl_orders')->insertGetId($orderData);



    }





}

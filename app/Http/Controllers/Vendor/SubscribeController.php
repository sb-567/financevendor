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
            'subscription_id' => $subscription->id
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


            $this->proccessOrder($input['razorpay_order_id'], $input['razorpay_payment_id'], $input['razorpay_signature'],$input['subid']);
            
            return redirect()->route('vendors.subcribtionplan')->with('success', 'Payment successful! Thank you for your order.');



            // ✅ Signature verified, proceed with DB logic
            // Save payment to DB, mark order paid, etc.
            // return response()->json(['status' => 'Payment successful']);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            // ❌ Invalid Signature
            Log::error('Razorpay Signature Error: ' . $e->getMessage());
            // return response()->json(['status' => 'Payment failed', 'error' => $e->getMessage()], 400);

            return redirect()->route('vendors.subcribtionplan')->with('error', 'Payment verification failed.');
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


    public function proccessOrder($order_id, $payment_id, $signature,$subscription_id)
    {   
        
        $subscriptiondata=DB::table('tbl_subscription')
        ->select('tbl_plans.title as plantitle','tbl_subscription.*')
        ->leftjoin('tbl_plans','tbl_plans.id','=','tbl_subscription.time_duration')
        ->where('tbl_subscription.id',$subscription_id)
        ->first();

        $start_date = now();
        $end_date = now();
        $no_of_lead=NULL;
        // Calculate end date based on subscription type
        if ($subscriptiondata->subscription_type == 1) {
            // Time based subscription
            
                $title = strtolower($subscriptiondata->plantitle);

                $number = (int) filter_var($title, FILTER_SANITIZE_NUMBER_INT);

                if (str_contains($title, 'day')) {
                    $end_date = now()->addDays($number);
                } elseif (str_contains($title, 'month')) {
                    $end_date = now()->addMonths($number);
                } elseif (str_contains($title, 'year')) {
                    $end_date = now()->addYears($number);
                }
        } elseif ($subscriptiondata->subscription_type == 2) {
            // Lead based subscription
            $end_date = null; // No expiry, depends on leads


            $no_of_lead = $subscriptiondata->no_of_leads;
        }

        
        $orderData = [
            'subscription_id' => $subscription_id,
            'agent_id' => session('vid'),
            'order_no' => $order_id,
            'payment_id' => $payment_id,
            'signature' => $signature,
            'amount' => $subscriptiondata->cross_price ?? 0,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'no_of_lead_get' => $no_of_lead,
            'used_no_of_lead' => $no_of_lead,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $order_id=DB::table('tbl_orders')->insertGetId($orderData);


        return redirect()->route('vendors.subcribtionplan')->with('success', 'payed sucessfully');

    }





}

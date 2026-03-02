<?php

namespace App\Http\Controllers;


use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function createOrder()
    {   

       
         $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $order = $api->order->create([
            'receipt'         => time(),
            'amount'          => 50000, // amount in paise = INR 500
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ]);

        return view('razorpay', ['order' => $order]);
    }

    public function paymentSuccess(Request $request)
    {
        $input = $request->all();
    
        // 1. Get your keys
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        // 2. Signature verification
        $generatedSignature = hash_hmac('sha256', $input['razorpay_order_id'] . '|' . $input['razorpay_payment_id'], config('services.razorpay.secret'));
    
        if ($generatedSignature === $input['razorpay_signature']) {
            // Payment is valid
            
            // ✅ Save payment info into database (example)
            // Payment::create([
            //     'payment_id' => $input['razorpay_payment_id'],
            //     'order_id' => $input['razorpay_order_id'],
            //     'status' => 'success'
            // ]);
    
            return response()->json(['success' => true]);
        } else {
            // 🛑 Invalid payment - maybe fraud
            Log::error('Razorpay Payment Failed - Signature Mismatch', $input);
            return response()->json(['success' => false]);
        }
    }
}
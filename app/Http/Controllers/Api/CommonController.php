<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Models\Ignorewords;
use App\Models\Village;
use App\Models\Lane;
use App\Models\Settings;
use App\Models\Youtubesettings;
use App\Models\News;
use App\Models\Services;
use App\Models\Userpost;
use App\Models\UserFavouritePost;
use App\Models\Bannerads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class CommonController extends Controller
{
    
    public function eventlist(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_events')
            ->where('user_id', '=', $rawData['user_id'])
            ->orderBy('id', 'desc')
            ->get();
        
        if ($data->isNotEmpty()) {
            // Fetch all event IDs to reduce queries
            $eventIds = $data->pluck('id');
        
            // Fetch all sub-events in one query
            $subEvents = DB::table('tbl_sub_events')
                ->whereIn('event_id', $eventIds)
                
                ->get()
                ->groupBy('event_id');
        
            // Attach sub-events to the main event data
            $data = $data->map(function ($d) use ($subEvents) {
                $d->subevents = $subEvents[$d->id] ?? []; // Attach sub-events if available
                return $d;
            });
        
            $response = [
                'status' => 1,
                'data' => $data,
            ];
        
            return response()->json($response, 200);
  
   
        
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }
    
    public function geteventbyid(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_events')->where('id','=',$rawData['id'])->first();
            
            if(!empty($data)) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }

    public function saveevent(Request $request)
    {
        

        $rawData = json_decode($request->getContent(), true);
      

        $insertData = [];
       
        $user_id= $rawData['user_id'] ;
        $event_title=$rawData['event_title'];
        $event_address=$rawData['event_address'];
        $event_datetime=$rawData['event_datetime'];

        if(!empty($rawData['user_id'])){

            $insertData['user_id'] = $user_id;
        
        }else{
            
            $response = [
                'message' => "User ID is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        $insertData['event_title'] = $event_title;
        $insertData['event_datetime'] = $event_datetime;
        $insertData['event_address'] = $event_address;
        $insertData['created_at'] = now();
        
        if(!empty($rawData['id'])){
    
             $insertData['updated_at'] = now();
            DB::table('tbl_events')->where('id', $rawData['id'])->update($insertData);
            
            if(empty($rawData['subevents'])){
                DB::table('tbl_sub_events')->where('event_id', $rawData['id'])->delete();
            }
            
             foreach ($rawData['subevents'] as $subevent) {
                    $insertsData = [
                        'sub_event_title' => $subevent['sub_event_title'] ?? null,
                        'event_date'      => $subevent['event_date'] ?? null,
                        'event_time'      => $subevent['event_time'] ?? null,
                        'event_id'        => $rawData['id'] 
                    ];
                    
                    // print_r($insertsData);
                
                    if (!empty($subevent['id'])) {
                        // Update existing sub-event
                        DB::table('tbl_sub_events')->where('id', $subevent['id'])->update($insertsData);
                    } else {
                        // Insert new sub-event
                        DB::table('tbl_sub_events')->insert($insertsData);
                    }
                }

            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                
                $eventId = DB::table('tbl_events')->insertGetId($insertData);
                
                // $subevents = json_decode($rawData['subevents'], true);

                foreach($rawData['subevents'] as $subevent){
                    
                    $insertsData['event_id'] = $eventId;
                    $insertsData['sub_event_title'] = $subevent['sub_event_title'];
                    $insertsData['event_date'] = $subevent['event_date'];
                    $insertsData['event_time'] = $subevent['event_time'];
                    $insertsData['created_at'] = now();
                  
        
                    DB::table('tbl_sub_events')->insert($insertsData);

                }
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }

        

        return response()->json($response, 200);



    }

    

    public function eventdelete(Request $request)
    {
        
       
        $rawData = json_decode($request->getContent(), true);
      
        // Ensure $user_id is set and update only if there are fields to update
        if (!empty($rawData['id'])) {
            DB::table('tbl_events')->where('id', $rawData['id'])->delete();
        }
        
        $response = [
            'message' => "Record Deleted Successfully.",
            'status' => "200",
        ];
        
        return response()->json($response, 200);
    

    }
    
    public function getsubeventbyid(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_sub_events')->where('event_id','=',$rawData['event_id'])->get();
            
            if(!empty($data)) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }



    public function savesubevent(Request $request)
    {
        

        $rawData = json_decode($request->getContent(), true);
      


        $event_id= $rawData['event_id'];
        $sub_event_title=$rawData['sub_event_title'];
        $event_date=$rawData['event_date'];
        $event_time=$rawData['event_time'];
        


        $insertData = [];


        if(!empty($rawData['event_id'])){

            $insertData['event_id'] = $event_id;
        
        }else{
            
            $response = [
                'message' => "Event ID is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        $insertData['sub_event_title'] = $sub_event_title;
      
        $insertData['event_date'] = $event_date;
        $insertData['event_time'] = $event_time;
        $insertData['updated_at'] = now();
        
        if(!empty($rawData['id'])){

            DB::table('tbl_sub_events')->where('id', $rawData['id'])->update($insertData);


            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                DB::table('tbl_sub_events')->insert($insertData);
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }

        

        return response()->json($response, 200);



    }

    

    public function subeventdelete(Request $request)
    {
        
       
        $rawData = json_decode($request->getContent(), true);
      
        // Ensure $user_id is set and update only if there are fields to update
        if (!empty($rawData['id'])) {
            DB::table('tbl_sub_events')->where('id', $rawData['id'])->delete();
        }
        
        $response = [
            'message' => "Record Deleted Successfully.",
            'status' => "200",
        ];
        
        return response()->json($response, 200);
    

    }


    public function getprefixlist(Request $request)
    {   
     
       
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_prefix')->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }


        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }
    
    public function saveprefixlist(Request $request)
    {   
     
       
       $rawData = json_decode($request->getContent(), true);
      


        $insertData = [];
        $name= $rawData['name'];

        if(empty($rawData['name'])){

            
            
            $response = [
                'message' => "Title is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        $insertData['name'] = $name;
        $insertData['status'] = 1;
        $insertData['created_at'] = now();
        
        if(!empty($rawData['id'])){

        $insertData['updated_at'] = now();
        
            DB::table('tbl_prefix')->where('id', $rawData['id'])->update($insertData);


            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                DB::table('tbl_prefix')->insert($insertData);
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }
        
    }
    
    
    public function guesttypeadd(Request $request)
    {   
     
       
       $rawData = json_decode($request->getContent(), true);
      


        $insertData = [];
        $name= $rawData['name'];

        if(empty($rawData['name'])){

            
            $response = [
                'message' => "Title is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        $insertData['name'] = $name;
       
        $insertData['created_at'] = now();
        
        if(!empty($rawData['id'])){

        $insertData['updated_at'] = now();
        
            DB::table('tbl_guest_type')->where('id', $rawData['id'])->update($insertData);


            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                DB::table('tbl_guest_type')->insert($insertData);
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }
        
    }
    
    
    public function getcurrencylist(Request $request)
    {   
     
       
        try {
            
            $data = DB::table('tbl_currency')->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }


        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }
    public function getguesttypelist(Request $request)
    {   
     
       
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_guest_type')->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }


        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }


    public function guestlist(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      

            // $data = Category::all()->sortBy("category_priority");
            try {
                $query = DB::table('tbl_guest');
            
                if (!empty($rawData['event_id'])) {
                    $query->where('event_id', '=', $rawData['event_id']);
                }
            
                $query->where('user_id', '=', $rawData['user_id']);
                $query->orderBy('id', 'desc');
            
                $data = $query->get(); // Execute query
            
                if ($data->isNotEmpty()) {
                    return response()->json([
                        'status' => 1,
                        'data' => $data
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => "No Data Found"
                    ], 404);
                }
            } catch (\Exception $e) {
                // \Log::error("Database Query Error: " . $e->getMessage());
            
                return response()->json([
                    'status' => 0,
                    'message' => "An error occurred. Please try again later."
                ], 500);
            }
            
    }


    public function saveguest(Request $request)
    {
        

        $rawData = json_decode($request->getContent(), true);
      

       
       


        $insertData = [];


        $insertData['prefix_name']=$rawData['prefix_id'];
        $insertData['name']=$rawData['name'];
        $insertData['mobile']=$rawData['mobile'];
        $insertData['address']=$rawData['address'];
        $insertData['category_id']=$rawData['category_id'];
        $insertData['special_tag']=$rawData['special_tag'];
        $insertData['event_id']=$rawData['event_id'];
    

        

        if(!empty($rawData['user_id'])){

            $insertData['user_id'] = $rawData['user_id'];
        
        }else{
            
            $response = [
                'message' => "User ID is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        
        if(!empty($rawData['id'])){

            DB::table('tbl_guest')->where('id', $rawData['id'])->update($insertData);

            DB::table('tbl_guest_invite')->where('guest_id', $rawData['id'])->delete();

            foreach($rawData['subevent'] as $guest_type){
                        
                $insertsData['guest_id'] = $rawData['id'];
                $insertsData['subevent_id'] = $guest_type['subevent_id'];
                $insertsData['person_count'] = $guest_type['person_count'];

                DB::table('tbl_guest_invite')->insert($insertsData);
                
            }


            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                
                $guestid=DB::table('tbl_guest')->insertGetId($insertData);

                foreach($rawData['subevent'] as $guest_type){
                        
                    $insertsData['guest_id'] = $guestid;
                    $insertsData['subevent_id'] = $guest_type['subevent_id'];
                    $insertsData['person_count'] = $guest_type['person_count'];

                    DB::table('tbl_guest_invite')->insert($insertsData);
                    
                }
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];


        }

        

        return response()->json($response, 200);



    }


    public function guestdelete(Request $request)
    {
        
       
        $rawData = json_decode($request->getContent(), true);
      
        // Ensure $user_id is set and update only if there are fields to update
        if (!empty($rawData['id'])) {
            DB::table('tbl_guest')->where('id', $rawData['id'])->delete();
        }
        
        $response = [
            'message' => "Record Deleted Successfully.",
            'status' => "200",
        ];
        
        return response()->json($response, 200);
    

    }



    public function vendorlist(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_vendors')
            // ->leftJoin('tbl_subevn', 'tbl_vendors.some_column', '=', 'tbl_subevn.some_column') // Uncomment and adjust as needed
                ->where('user_id', '=', $rawData['user_id']);
            
            if (!empty($rawData['event_id'])) {
                $data->where('event_id', '=', $rawData['event_id']);
            }
            
            $data = $data->orderBy('id', 'desc')->get();

            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }
    
    public function getvendorbyid(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_vendors')->where('id','=',$rawData['id'])->first();
            
            if(!empty($data)) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }

    public function savevendor(Request $request)
    {
        

        $rawData = json_decode($request->getContent(), true);
        
        $insertData = [];


        $insertData['name']= $rawData['name'];
        $insertData['mobile']= $rawData['mobile'];
        $insertData['event_id']= $rawData['event_id'];
        $insertData['task_id']= $rawData['task_id'];
        $insertData['amount']= $rawData['amount'];
        $insertData['advance_amount']= $rawData['advance_amount'];
        $insertData['state_id']= $rawData['state_id'] ?? null;
        $insertData['district_id']= $rawData['district_id'] ?? null;
        $insertData['sub_district_id']= $rawData['sub_district_id'] ?? null;
        $insertData['booking_status']= $rawData['booking_status'];
        
        
        
        
        // foreach ( as $subevent) {
        //             $sub_event_id = [
        //                 'id' => $subevent['sub_event_title'] ?? null,
                        
        //             ];
                    
        // }
                    
                    
                    
        $insertData['sub_event_id']= json_encode($rawData['sub_event_id']);

        if(!empty($rawData['user_id'])){

            $insertData['user_id'] = $rawData['user_id'];
        
        }else{
            
            $response = [
                'message' => "User ID is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }

        
        if(!empty($rawData['id'])){

            DB::table('tbl_vendors')->where('id', $rawData['id'])->update($insertData);

            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];

        }else{

            if(!empty($insertData)) {
                 DB::table('tbl_vendors')->insert($insertData);
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }

        

        return response()->json($response, 200);



    }

    

    public function vendordelete(Request $request)
    {
        
       
        $rawData = json_decode($request->getContent(), true);
      
        // Ensure $user_id is set and update only if there are fields to update
        if (!empty($rawData['id'])) {
            DB::table('tbl_vendors')->where('id', $rawData['id'])->delete();
        }
        
        $response = [
            'message' => "Record Deleted Successfully.",
            'status' => "200",
        ];
        
        return response()->json($response, 200);
    

    }



    public function getbudgetlist(Request $request){


        $rawData = json_decode($request->getContent(), true);

      
        // $data = Category::all()->sortBy("category_priority");
        try {
            $query = DB::table('tbl_vendors');
        
            // Apply ordering
            $query->orderBy('id', 'desc');
            
            if(!empty($rawData['user_id'])){
                $query->where('user_id', '=',$rawData['user_id']);
            }
            if(!empty($rawData['event_id'])){
                $query->where('event_id', '=',$rawData['event_id']);
            }
    
            $query->orderBy('id', 'desc');
        
            $data = $query->get(); // Execute query
        
            if ($data->isNotEmpty()) {
                return response()->json([
                    'status' => 1,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => "No Data Found"
                ], 404);
            }
        } catch (\Exception $e) {
            // \Log::error("Database Query Error: " . $e->getMessage());
        
            return response()->json([
                'status' => 0,
                'message' => "An error occurred. Please try again later."
            ], 500);
        }




    }
    
   

    


     public function tasklist(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            
            $query = DB::table('tbl_event_task');
            
            if(!empty($rawData['user_id'])){
                $query->where('user_id','=',$rawData['user_id']);
            }

            if(!empty($rawData['event_id'])){
                $query->where('event_id','=',$rawData['event_id']);
            }

            $query->orderBy('id', 'desc');
            
            $data = $query->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }
    
    public function gettaskbyid(Request $request)
    {   
     
        $rawData = json_decode($request->getContent(), true);
      
        try {
            // $data = Category::all()->sortBy("category_priority");
            $data = DB::table('tbl_event_task')->where('id','=',$rawData['id'])->first();
            
            if(!empty($data)) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        
    }

    public function savetask(Request $request)
    {
        

        $rawData = json_decode($request->getContent(), true);
      
        $insertData = [];

        $insertData['event_task_title']= $rawData['event_task_title'] ;
        $insertData['event_id']= $rawData['event_id'] ;
        
        

        if(!empty($rawData['user_id'])){

            $insertData['user_id'] = $rawData['user_id'];
        
        }else{
            
            $response = [
                'message' => "User ID is required.",
                'status' => "400",
            ];
            return response()->json($response, 400);

        }



        
        
        if(!empty($rawData['id'])){

            DB::table('tbl_event_task')->where('id', $rawData['id'])->update($insertData);


            $response = [
                'message' => "Record Updated Successfully.",
                'status' => "200",
            ];


        }else{

            if(!empty($insertData)) {
                
                 DB::table('tbl_event_task')->insert($insertData);
             
            }

            $response = [
                'message' => "Record Inserted Successfully.",
                'status' => "200",
            ];

        }

        

        return response()->json($response, 200);



    }

    public function taskstatus(Request $request){


        $rawData = json_decode($request->getContent(), true);
      
        $insertData = [];

        $insertData['task_status']= $rawData['task_status'];
      

        DB::table('tbl_event_task')->where('id', $rawData['task_id'])->update($insertData);


        $response = [
            'message' => "Record Updated Successfully.",
            'status' => "200",
        ];


        return response()->json($response, 200);


    }
    

    public function taskdelete(Request $request)
    {
        
       
        $rawData = json_decode($request->getContent(), true);
      
        // Ensure $user_id is set and update only if there are fields to update
        if (!empty($rawData['id'])) {
            DB::table('tbl_event_task')->where('id', $rawData['id'])->delete();
        }
        
        $response = [
            'message' => "Record Deleted Successfully.",
            'status' => "200",
        ];
        
        return response()->json($response, 200);
    

    }


    public function tasklistsuggestion(Request $request){
        

        $rawData = json_decode($request->getContent(), true);
      
        try {
            
            $query = DB::table('tbl_task_list');
            
            if(!empty($rawData['user_id'])){
                $query->where('user_id','=',$rawData['user_id']);
            }

            if(!empty($rawData['event_id'])){
                $query->where('event_id','=',$rawData['event_id']);
            }

            $query->orderBy('id', 'desc');
            
            $data = $query->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }


    }
    
    public function statelist(Request $request){
        

        // $rawData = json_decode($request->getContent(), true);
      
        try {
            
            $query = DB::table('tbl_states');
            
            // if(!empty($rawData['user_id'])){
            //     $query->where('user_id','=',$rawData['user_id']);
            // }

            // if(!empty($rawData['event_id'])){
            //     $query->where('event_id','=',$rawData['event_id']);
            // }

            $query->orderBy('id', 'desc');
            
            $data = $query->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }


    }
    
    public function districtlistbtstateid(Request $request){
        

        $rawData = json_decode($request->getContent(), true);
      
        try {
            
            $query = DB::table('tbl_district');
            
            // if(!empty($rawData['user_id'])){
            //     $query->where('user_id','=',$rawData['user_id']);
            // }

            if(!empty($rawData['state_id'])){
                $query->where('state_id','=',$rawData['state_id']);
            }

            $query->orderBy('id', 'desc');
            
            $data = $query->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }


    }
    public function subdistrictlistbydistrictid(Request $request){
        

        $rawData = json_decode($request->getContent(), true);
      
        try {
            
            $query = DB::table('tbl_subdistrict');
            
            // if(!empty($rawData['user_id'])){
            //     $query->where('user_id','=',$rawData['user_id']);
            // }

            if(!empty($rawData['district_id'])){
                $query->where('district_id','=',$rawData['district_id']);
            }

            $query->orderBy('id', 'desc');
            
            $data = $query->get();
            
            if(count($data) > 0) {
                $response = [
                    'status' => 1,
                    'data' => $data
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => 0,
                    'message' => "No Data Found"
                ];
                return response()->json($response, 204);
            }
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => "An error occurred: " . $e->getMessage()
            ];
            return response()->json($response, 500);
        }


    }

    
}

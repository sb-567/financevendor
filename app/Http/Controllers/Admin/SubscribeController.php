<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class SubscribeController extends Controller
{
    
     public function plandescriptionlist(){
        $data['title']="Plan Description";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/subscription/plandesc',$data);
    }




    public function getplandescriptiondata(Request $request){


        $query = DB::table('tbl_plans')
            // ->select('tbl_plans.*', 'tbl_vendors.name as vendor_name')
            // ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_plans.vendor_id')
            ->orderBy('tbl_plans.id', 'desc');

   


        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_plans.title', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_plans.phone', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_plans.email', 'like', "%{$keyword}%");
                    });
                }
            })
            // Checkbox column
            ->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkBox_' . $row->id . '" value="' . $row->id . '">
                            <label class="custom-control-label" for="checkBox_' . $row->id . '"></label>
                        </div>';
            })
            // Action column
            ->addColumn('action', function ($row) {
            
                        return '<div class="d-flex">
                                    <a href="' . url('plandescriptionedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
             // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){
                    return '<div class="form-check form-switch">
                            <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

                        </div>';
                }else{

                    return '<div class="form-check form-switch">
                        <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" >

                    </div>';

                }
                
            })
            
            // ->editColumn('created_at', function ($row) {
            //     return date('d-m-Y h:i a', strtotime($row->created_at));
            // })
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox','status', 'action'])
            ->make(true);


    }

    


    public function plandescriptionedit(Request $request){

        $data['title']="Plan Description Edit";
        $data['fetched']=DB::table('tbl_plans')->where('id','=',$request->id)->first();
        
        
    //  $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view('admin/subscription/plandescadd', $data);

    }

    public function plandescriptioncreate(){

        $data['title']="Plan Description Create";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/subscription/plandescadd',$data);
    }


    public function plandescriptionsave(Request $request){
        
        $request->validate([
            'title' => 'required'
        ]);

        if ($request->input('id') != "") {
           
            DB::table('tbl_plans')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'updated_at' => now() 
            ]);
    
    
        } else {
    
            DB::table('tbl_plans')->insert([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Plan saved successfully');
        
        
         return redirect('plandescriptionlist');



    }


    public function plandescriptionstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_plans')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_plans')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'plan status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'plan not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_plans')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'plan created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function plandescriptiondelete(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_plans')->where('id', $id)->delete();
        return;

    }

    public function deleteselectedplandescription(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_plans')->where('id', $item)->delete();
        }
        return;
    }
     
    
    
    
    public function subscriptionplanlist(){
        $data['title']="Subscription Plan";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/subscription/subscribtion',$data);
    }




    public function getsubscriptionplandata(Request $request){


        $query = DB::table('tbl_subscription')
            // ->select('tbl_plans.*', 'tbl_vendors.name as vendor_name')
            // ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_plans.vendor_id')
            ->orderBy('tbl_subscription.id', 'desc');

   


        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_subscription.title', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_plans.phone', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_plans.email', 'like', "%{$keyword}%");
                    });
                }
            })
            // Checkbox column
            ->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkBox_' . $row->id . '" value="' . $row->id . '">
                            <label class="custom-control-label" for="checkBox_' . $row->id . '"></label>
                        </div>';
            })
            // Action column
            ->addColumn('action', function ($row) {
            
                        return '<div class="d-flex">
                                    <a href="' . url('subscriptionplanedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
             // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){
                    return '<div class="form-check form-switch">
                            <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

                        </div>';
                }else{

                    return '<div class="form-check form-switch">
                        <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" >

                    </div>';

                }
                
            })
            
            // ->editColumn('created_at', function ($row) {
            //     return date('d-m-Y h:i a', strtotime($row->created_at));
            // })
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox','status', 'action'])
            ->make(true);


    }

    


    public function subscriptionplanedit(Request $request){

        $data['title']="Subscription Plan Edit";
        $data['fetched']=DB::table('tbl_plans')->where('id','=',$request->id)->first();
        
        
    //  $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view('admin/subscription/subscriptionadd', $data);

    }

    public function subscriptionplancreate(){

        $data['title']="Subscription Plan Create";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/subscription/subscriptionadd',$data);
    }


    public function subscriptionplansave(Request $request){
        
        $request->validate([
            'title' => 'required'
        ]);

        if ($request->input('id') != "") {
           
            DB::table('tbl_plans')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'updated_at' => now() 
            ]);
    
    
        } else {
    
            DB::table('tbl_plans')->insert([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Plan saved successfully');
        
        
         return redirect('subscriptionplanlist');



    }


    public function subscriptionplanstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_plans')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_plans')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Subscription Plan status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription plan not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_plans')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'Subscription plan created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function subscriptionplandelete(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_plans')->where('id', $id)->delete();
        return;

    }

    public function deleteselectedsubscriptionplan(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_plans')->where('id', $item)->delete();
        }
        return;
    }



}

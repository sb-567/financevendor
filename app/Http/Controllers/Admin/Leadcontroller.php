<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 


class Leadcontroller extends Controller
{

    public function index(){
        $data['title']="Lead";
        $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/lead/lead',$data);
    }




    public function getleadlistdata(Request $request){

    
        

        $query = DB::table('tbl_leads')
            ->select('tbl_leads.*', 'tbl_vendors.name as vendor_name')
            ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_leads.vendor_id')
            ->orderBy('tbl_leads.id', 'desc');

        if ($request->vendor_id) {
            $query->where('tbl_leads.vendor_id', $request->vendor_id);
        }


        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_leads.name', 'like', "%{$keyword}%");
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
                                    <a href="' . url('leadedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'action'])
            ->make(true);


    }

    


    public function vendoredit(Request $request){

        $data['title']="Lead Edit";
        $data['fetched']=DB::table('tbl_leads')->where('id','=',$request->id)->first();
        
        
     $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view( 'admin/lead/leadadd', $data);

    }

    public function create(){

        $data['title']="Lead Create";
        $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/lead/leadadd',$data);
    }


    public function leadsave(Request $request){
        
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'vendor_id' => 'required',
            'status' => 'required',
        ]);

        if ($request->input('id') != "") {
           
            DB::table('tbl_leads')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'vendor_id' => $request->input('vendor_id'),
                'status' =>$request->input('status'),
                'created_at' => now(),
                'updated_at' => now() 
            ]);
    
    
        } else {
    
            DB::table('tbl_leads')->insert([
                  'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'vendor_id' => $request->input('vendor_id'),
                'status' =>$request->input('status'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Lead saved successfully');
        
        
         return redirect('leadlist');



    }


    public function leadstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_vendors')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_vendors')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'vendor status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'vendor not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_vendors')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'Vendor created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function destroy(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_leads')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_leads')->where('id', $item)->delete();
        }
        return;
    }


    public function exportlead(Request $request)
    {
        $vendor_id = $request->input('vendor_id');
        
        // Fetch leads based on vendor_id
        $leads = DB::table('tbl_leads')
            ->where('vendor_id', $vendor_id)
            ->get();

        // Export logic here (e.g., generate CSV, Excel, etc.)
        // For demonstration, we'll just return the leads as JSON
        return response()->json($leads);
    }

}

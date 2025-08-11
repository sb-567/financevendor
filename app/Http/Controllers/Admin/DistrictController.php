<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    


    public function index(){
        $data['title']="District";
        return view( 'district/districtlist',$data);
    }

    public function getdistrictlistdata(Request $request){


        $query = DB::table('tbl_district');
        
        // Apply ordering
        $query->orderBy('id', 'desc');
        $query->leftJoin('tbl_states', 'tbl_district.state_id', '=', 'tbl_states.id')
        ->select('tbl_district.*', 'tbl_states.state_title as state_title'); 
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('district_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('districtedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){
                    return '<div class="form-check form-switch">
                            <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

                        </div>';
                }else{

                    return '<div class="form-check form-switch">
                        <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" >

                    </div>';

                }
                
            })
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status', 'action'])
            ->make(true);


    }


    public function districtedit(Request $request){

        $data['title']="District Edit";
        $data['fetched']=DB::table('tbl_district')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
        return view( 'district/districtadd', $data);

    }

    public function create(){

        $data['title']="District Create";
       $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
        return view( 'district/districtadd',$data);
    }


    public function districtsave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_district')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'district_title' => $request->input('district_title'),
                'state_id' => $request->input('state_id'),
                'status' => $request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_district')->insert([
                'district_title' => $request->input('district_title'),
                'state_id' => $request->input('state_id'),
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'District saved successfully');
        
         return redirect('districtlist');


    }


    public function districtstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $task = DB::table('tbl_district')->where('id', $request->input('id'))->first();
        
            if ($task) {
                DB::table('tbl_district')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_district')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'New event created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function destroy(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_district')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_district')->where('id', $item)->delete();
        }
        return;
    }
    
    
    
    public function subdistrictlist(){
        $data['title']="Sub District";
        return view( 'subdistrict/subdistrictlist',$data);
    }

    public function getsubdistrictlistdata(Request $request){


        $query = DB::table('tbl_subdistrict');
        
        // Apply ordering
        $query->orderBy('tbl_subdistrict.id', 'desc');
        $query->leftJoin('tbl_states', 'tbl_subdistrict.state_id', '=', 'tbl_states.id');
        $query->leftJoin('tbl_district', 'tbl_subdistrict.district_id', '=', 'tbl_district.id')
        ->select('tbl_subdistrict.*','tbl_district.district_title', 'tbl_states.state_title as state_title'); 
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('subdistrict_title', 'like', "%{$keyword}%");
                        $q->orWhere('district_title', 'like', "%{$keyword}%");
                        $q->orWhere('state_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('subdistrictedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){
                    return '<div class="form-check form-switch">
                            <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

                        </div>';
                }else{

                    return '<div class="form-check form-switch">
                        <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" >

                    </div>';

                }
                
            })
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status', 'action'])
            ->make(true);


    }


    public function subdistrictedit(Request $request){

        $data['title']="Sub District Edit";
        $data['fetched']=DB::table('tbl_subdistrict')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
        return view( 'subdistrict/subdistrictadd', $data);

    }

    public function subdistrictcreate(){

        $data['title']="Sub District Create";
       $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
        return view( 'subdistrict/subdistrictadd',$data);
    }

    public function getdistrict(Request $request){
        $state_id = $request->state_id;

        $old_district_id = $request->old_district_id;
        
        $districts = DB::table('tbl_district')->where('state_id','=',$state_id)->get();
        

        $str="";

        if(!empty($districts)){
            $str.="<option value=''>Select District</option>";
            foreach($districts as $district){

                if($old_district_id==$district->id){
                    $str.="<option value='".$district->id."' selected>".$district->district_title."</option>";
                }else{
                    $str.="<option value='".$district->id."'>".$district->district_title."</option>";
                }
            }
        }

        return $str;
    }
    
    public function getsubdistrict(Request $request){
        $district_id = $request->district_id;

        $old_sub_district_id = $request->old_sub_district_id;
        
        $subdistricts = DB::table('tbl_subdistrict')->where('district_id','=',$district_id)->get();
        

        $str="";

        if(!empty($subdistricts)){
            $str.="<option value=''>Select District</option>";
            foreach($subdistricts as $district){

                if($old_sub_district_id==$district->id){
                    $str.="<option value='".$district->id."' selected>".$district->subdistrict_title."</option>";
                }else{
                    $str.="<option value='".$district->id."'>".$district->subdistrict_title."</option>";
                }
            }
        }

        return $str;
    }

    public function subdistrictsave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_subdistrict')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'subdistrict_title' => $request->input('subdistrict_title'),
                'district_id' => $request->input('district_id'),
                'state_id' => $request->input('state_id'),
                'status' => $request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_subdistrict')->insert([
               'subdistrict_title' => $request->input('subdistrict_title'),
                'district_id' => $request->input('district_id'),
                'state_id' => $request->input('state_id'),
                'status' => $request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'District saved successfully');
        
         return redirect('subdistrictlist');


    }


    public function subdistrictstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $task = DB::table('tbl_subdistrict')->where('id', $request->input('id'))->first();
        
            if ($task) {
                DB::table('tbl_subdistrict')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_subdistrict')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'New event created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function subdistrictdelete(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_subdistrict')->where('id', $id)->delete();
        return;

    }

    public function deleteselectedsubdistrict(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_subdistrict')->where('id', $item)->delete();
        }
        return;
    }



}

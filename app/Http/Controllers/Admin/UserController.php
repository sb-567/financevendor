<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(){
        $data['title']="Users";
        return view( 'users/userslist',$data);
    }

    public function getuserlistdata(Request $request){


        $query = DB::table('tbl_users');
        
        // Apply ordering
        $query->orderBy('tbl_users.id', 'desc');
        $query->leftJoin('tbl_states', 'tbl_users.state_id', '=', 'tbl_states.id');
        $query->leftJoin('tbl_district', 'tbl_users.district_id', '=', 'tbl_district.id');
        $query->leftJoin('tbl_subdistrict', 'tbl_users.subdistrict_id', '=', 'tbl_subdistrict.id')
        
        ->select('tbl_users.*', 'tbl_subdistrict.subdistrict_title', 'tbl_district.district_title', 'tbl_states.state_title as state_title'); 
        
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_users.name', 'like', "%{$keyword}%");
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
                                    <a href="' . url('useredit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){

                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-switch statuschange"  type="checkbox"  role="switch" data-id="' . $row->id.'" checked>

                            </div>';
                }else{

                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-switch statuschange" type="checkbox"  role="switch" data-id="' . $row->id.'" >

                            </div>';

                }
                
            })
            ->editColumn('name', function ($row) {

                

                    return '<a href="' . url('eventlist/' . $row->id) . '">'.$row->name.'</a>';
                
                
                
            })
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'name', 'status', 'action'])
            ->make(true);


    }


    public function useredit(Request $request){

        $data['title']="Users Edit";
        $data['fetched']=DB::table('tbl_users')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        return view( 'users/usersadd', $data);

    }

    public function create(){

        $data['title']="Users Create";
        $data['events']= DB::table('tbl_events')->get();
        return view( 'users/usersadd',$data);
    }


    public function userssave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_users')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'profile' => $request->input('profile'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'state_id' => $request->input('state_id'),
                'district_id' => $request->input('district_id'),
                'subdistrict_id' => $request->input('subdistrict_id'),
                'status' =>$request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_users')->insert([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'profile' => $request->input('profile'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'state_id' => $request->input('state_id'),
                'district_id' => $request->input('district_id'),
                'subdistrict_id' => $request->input('subdistrict_id'),
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'Users saved successfully');
        
         return redirect('userslist');


    }


    public function userstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_users')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_users')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Users status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Users not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_users')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'Users created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function destroy(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_users')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_users')->where('id', $item)->delete();
        }
        return;
    }
}

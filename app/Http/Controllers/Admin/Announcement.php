<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Announcement extends Controller
{
    public function index()
    {
        $data['title'] = "User List";
        return view('admin.announcement.announcementlist', $data);
    }

    public function getannouncementlistdata(Request $request)
    {
        $query = DB::table('tbl_announcement');
        
        // Apply ordering
        $query->orderBy('tbl_announcement.id', 'desc');
        // $query->leftJoin('tbl_states', 'tbl_admin.state_id', '=', 'tbl_states.id');
        // $query->leftJoin('tbl_district', 'tbl_admin.district_id', '=', 'tbl_district.id');
        // $query->leftJoin('tbl_subdistrict', 'tbl_admin.subdistrict_id', '=', 'tbl_subdistrict.id')
        
        // ->select('tbl_admin.*'); 
        
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_announcement.message', 'like', "%{$keyword}%");
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
                                    <a href="' . url('announcementedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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
            
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status', 'action'])
            ->make(true);
    }


    public function announcementedit(Request $request){

        $data['title']="Announcement Edit";
        $data['fetched']=DB::table('tbl_announcement')->where('id','=',$request->id)->first();
          $data['role']= DB::table('tbl_roles')->get();
        return view('admin.announcement.announcementadd', $data);

    }

    public function create(){

        $data['title']="Announcement Create";
        // $data['role']= DB::table('tbl_roles')->get();
        return view( 'admin.announcement.announcementadd',$data);
    }


    public function announcementsave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_announcement')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'message' => $request->input('message'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'status' =>$request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_announcement')->insert([
                'message' => $request->input('message'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'Announcement saved successfully');
        
         return redirect('announcementlist');


    }


    public function announcementstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_announcement')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_announcement')
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
            $id = DB::table('tbl_announcement')->insertGetId([
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
        DB::table('tbl_announcement')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_announcement')->where('id', $item)->delete();
        }
        return;
    }
}

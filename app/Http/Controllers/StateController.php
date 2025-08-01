<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class StateController extends Controller
{
    


    public function index(){
        $data['title']="State";
        return view( 'state/statelist',$data);
    }

    public function getstatelistdata(Request $request){


        $query = DB::table('tbl_states');
        
        // Apply ordering
        $query->orderBy('id', 'desc');
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('state_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('stateedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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


    public function stateedit(Request $request){

        $data['title']="State Edit";
        $data['fetched']=DB::table('tbl_states')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        return view( 'state/stateadd', $data);

    }

    public function create(){

        $data['title']="State Create";
       
        return view( 'state/stateadd',$data);
    }


    public function statesave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_states')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'state_title' => $request->input('state_title'),
                'status' => $request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_states')->insert([
                'state_title' => $request->input('state_title'),
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'State title saved successfully');
        
         return redirect('statelist');


    }


    public function statestatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $task = DB::table('tbl_states')->where('id', $request->input('id'))->first();
        
            if ($task) {
                DB::table('tbl_states')
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
            $id = DB::table('tbl_states')->insertGetId([
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
        DB::table('tbl_states')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_states')->where('id', $item)->delete();
        }
        return;
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class TaskController extends Controller
{
    


    public function index(){
        $data['title']="Task";
        return view( 'task/tasklist',$data);
    }

    public function gettasklistdata(Request $request){


        $query = DB::table('tbl_task_list');
        
        // Apply ordering
        $query->orderBy('tbl_task_list.id', 'desc');

        // $query->leftJoin('tbl_states', 'tbl_task_list.state_id', '=', 'tbl_states.id');
        $query->select('tbl_task_list.*'); 
       
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('task_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('taskedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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
           
            ->editColumn('state', function ($row) {

                $states = json_decode($row->states_id);
                $state = "";
                foreach($states as $key=>$value){
                    $state .= DB::table('tbl_states')->where('id','=',$value)->first()->state_title.", ";
                }
                return $state;
                
            })
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status','state', 'action'])
            ->make(true);


    }


    public function taskedit(Request $request){

        $data['title']="Task Edit";
        $data['fetched']=DB::table('tbl_task_list')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
        return view( 'task/taskadd', $data);

    }

    public function create(){

        $data['title']="Task Create";
        $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
       
        return view( 'task/taskadd',$data);
    }


    public function tasksave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_task_list')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'task_title' => $request->input('task_title'),
                'states_id' => json_encode($request->input('states_id')),
            
                'status' => $request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_task_list')->insert([
                'task_title' => $request->input('task_title'),
                'states_id' => json_encode($request->input('states_id')),
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'Task title saved successfully');
        
         return redirect('tasklist');


    }


    public function taskstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $task = DB::table('tbl_task_list')->where('id', $request->input('id'))->first();
        
            if ($task) {
                DB::table('tbl_task_list')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Event status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_task_list')->insertGetId([
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
        DB::table('tbl_task_list')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_task_list')->where('id', $item)->delete();
        }
        return;
    }



    public function usertasklist(Request $request){
        $data['title']="Task";
        $data['page']="task";
        $data['user_id'] = $request->user_id;

        $url = request()->fullUrl();

        Session::put('redirectionurl', $url);



        return view( 'eventtask/eventtasklist',$data);
    }

    public function getusertasklistdata(Request $request){


        $query = DB::table('tbl_event_task');
        $query->orderBy('tbl_event_task.id', 'desc');
        $query->leftJoin('tbl_events', 'tbl_events.id', '=', 'tbl_event_task.event_id');
        $query->select('tbl_event_task.*','tbl_events.event_title');
        if($request->user_id){
            $query->where('tbl_event_task.user_id', '=',$request->user_id); 
        }
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('event_task_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('usertaskedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // ->addColumn('sub_event_title', function ($row) {
            
            //     $subevent = json_decode($row->subevent_id);
            //     $state = "";
            //     foreach($subevent as $key=>$value){
            //         $state .= DB::table('tbl_sub_events')->where('id','=',$value)->first()->sub_event_title.", ";
            //     }
            //     return $state;
            // })

            
            // Status column with badge
           
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'action'])
            ->make(true);


    }


    public function usertaskedit(Request $request){

        $data['title']="Task Edit";
        $data['fetched']=DB::table('tbl_event_task')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        
        return view( 'eventtask/eventtaskadd', $data);

    }

    public function usertaskcreate(){

        $data['title']="Task Create";
        $data['states']= DB::table('tbl_states')->where('status','=',1)->get();
       
        return view( 'task/taskadd',$data);
    }


    public function usertasksave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_event_task')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'event_task_title' => $request->input('event_task_title'),
                // 'event_id' => json_encode($request->input('event_id')),
                'event_id' => $request->input('event_id')
            ]);
    
    
        } else {
    
            DB::table('tbl_event_task')->insert([
                'event_task_title' => $request->input('event_task_title'),
                // 'event_id' => json_encode($request->input('event_id')),
                // 'status' =>$request->input('status')
                'event_id' => $request->input('event_id')
            ]);
            
        }
         
         session()->flash('success', 'Task title saved successfully');
        
       


         $redirectUrl = Session::get('redirectionurl');

         // Forget session before redirection
         Session::forget('redirectionurl');
 
         return redirect($redirectUrl);


    }


    public function usertaskstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $task = DB::table('tbl_event_task')->where('id', $request->input('id'))->first();
        
            if ($task) {
                DB::table('tbl_event_task')
                    ->where('id', $request->input('id'))
                    ->update(['status' => $request->input('status')]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Event status updated successfully!',
                    'id' => $request->input('id'),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found!',
                ], 404);
            }
        } else {
            $id = DB::table('tbl_event_task')->insertGetId([
                'status' => $request->input('status')
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'New event created successfully!',
                'id' => $id, // Return newly inserted ID
            ]);
        }
        
    }

    public function usertaskdelete(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_event_task')->where('id', $id)->delete();
        return;

    }

    public function deleteselectedusertask(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_event_task')->where('id', $item)->delete();
        }
        return;
    }



}

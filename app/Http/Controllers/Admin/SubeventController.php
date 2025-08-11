<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Subevent;
use Illuminate\Http\Request;

class SubeventController extends Controller
{
    

    public function index(Request $request){


        $data['event_id']=$request->event_id;
        $data['user_id']=$request->user_id;
        $data['page'] = "subevents";
        return view( 'subevents/subeventlist',$data);
    }

    public function getsubeventlistdata(Request $request){


        $query = DB::table('tbl_sub_events');
        
        // Apply ordering
        $query->orderBy('id', 'desc');
        $query->where('event_id', '=',$request->event_id);
        
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('sub_event_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('subeventedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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
            
            ->editColumn('event_date', function ($row) {

                return date('d-m-Y',strtotime($row->event_date));
                
            })
            ->editColumn('event_time', function ($row) {

                return date('h:i a',strtotime($row->event_time));
                
            })
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status','event_date','event_time', 'action'])
            ->make(true);


    }


    public function subeventedit(Request $request){

        $data['title']="Events Edit";
        $data['fetched']=Subevent::find($request->id);
        $data['events']= DB::table('tbl_events')->get();
        return view( 'subevents/subeventadd', $data);

    }

    public function create(){

        $data['title']="Sub Events Create";
        $data['events']= DB::table('tbl_events')->get();
        return view( 'subevents/subeventadd',$data);
    }


    public function subeventsave(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Subevent::find($request->input('id'));

            $res->event_id=$request->input('event_id');
            $res->sub_event_title=$request->input('sub_event_title');
            $res->event_date=$request->input('event_date');
            $res->event_time=$request->input('event_time');
            $res->status=$request->input('status');
            $res->save();
    
        } else {
    
            $res = new Subevent();
            $res->event_id=$request->input('event_id');
            $res->sub_event_title=$request->input('sub_event_title');
            $res->event_date_time=$request->input('event_date_time');
            $res->status=$request->input('status');
            $res->created_at=date('Y-m-d h:i:s');
            $res->save();
            
        }

        $getuidbyevent=DB::table('tbl_events')->where('id', $request->input('event_id'))->first();
    
         // Set a success message in the session
         session()->flash('success', 'Sub Event saved successfully');
        
         return redirect('subeventlist/'.$request->input('event_id').'/'.$getuidbyevent->user_id);


    }


    public function subeventstatuschange(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Subevent::find($request->input('id'));
            $res->status=$request->input('status');
            $res->save();


            if ($res) {
                $res->status = $request->input('status');
                $res->save();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Event status updated successfully!',
                    'id' => $res->id,
                    'new_status' => $res->status
                ]);

            } else {

                return response()->json([
                    'success' => false,
                    'message' => 'Event not found!'
                ], 404);
            }


    
        } else {
    
            $res = new Subevent();
            $res->status=$request->input('status');
            $res->save();


            return response()->json([
                'success' => true,
                'message' => 'New event created successfully!',
                'id' => $res->id,
                'new_status' => $res->status
            ]);
            
        }
    
         


    }

    public function destroy(Subevent $subevent,Request $request)
    {   

        $id=$request->id;
        Subevent::destroy(array('id',$id));
        return;
    }

    public function selecteddestroy(Subevent $subevent,Request $request){
        foreach($request->items as $item){
            Subevent::destroy(array('id',$item));
        }
        return;
    }


    public function getsubeventbyid(Request $request){

       $event_id = $request->event_id;

       
       $old_sub_event_id = json_decode($request->old_sub_event_id);

    //    print_r($old_sub_event_id);
    //    die;
        
        $subevents = DB::table('tbl_sub_events')->where('event_id','=',$event_id)->get();
        

        $str="";

        if(!empty($subevents)){
            
            foreach($subevents as $sube){

                if(in_array($sube->id,$old_sub_event_id)){
                    $checked="checked";
                }else{
                    $checked="";
                }


                 $str .='<div class="col-md-2">
                            <div class="boxcontent">
                                <input type="checkbox" id="s'.$sube->id.'" name="sub_event_id[]" value="'.$sube->id.'" '.$checked.'>
                                <label for="s'.$sube->id.'">'.$sube->sub_event_title.'</label>
                            </div>
                        </div>';
                        
                    

                // }
            }
        }

        return $str;

     
    }

}

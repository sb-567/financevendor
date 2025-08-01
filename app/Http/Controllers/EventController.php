<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    

    public function index(Request $request){

        $data['user_id'] = $request->user_id;
        $data['event_id'] =  "";
        $data['page'] = "events";
        return view( 'events/eventlist',$data);
    }

   

    public function geteventlistdata(Request $request){


        $query = DB::table('tbl_events');
        
        // Apply ordering
        $query->orderBy('id', direction: 'desc');
        $query->where('user_id', '=',$request->user_id);
        
        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('event_title', 'like', "%{$keyword}%");
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
                                    <a href="' . url('vendorlistbyeventid/'.$row->user_id.'/'.$row->id) . '"  class="btn btn-sm btn-primary me-2"> Vendor</a>
                                    <a href="' . url('guestlistbyeventid/'.$row->id.'/'.$row->user_id) . '"  class="btn btn-sm btn-primary me-2"> Guest</a>
                                    <a href="' . url('budgetlistbyeventid/'. $row->user_id.'/'. $row->id) . '"  class="btn btn-sm btn-primary me-2"> Budget</a>
                                    <a href="' . url('eventedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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
            ->editColumn('event_title', function ($row) {
                return '<a href="' . url('subeventlist/' . $row->id.'/'.$row->user_id) . '">'.$row->event_title.'</a>';
            })
            // Set row attributes
            // ->setRowAttr([
            //     'data-url' => function ($row) {
            //         return url('subcategories_edit/' . $row->id);
            //     }
            // ])
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox','event_title','status', 'action'])
            ->make(true);


    }


    public function eventedit(Request $request){

        $data['title']="Events Edit";
        $data['fetched']=Event::find($request->id);
        return view( 'events/eventadd', $data);

    }

    public function create(){

        $data['title']="Events Create";

        return view( 'events/eventadd',$data);
    }


    public function eventsave(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Event::find($request->input('id'));

            $res->event_title=$request->input('event_title');
            $res->status=$request->input('status');
    
            $res->save();
    
        } else {
    
            $res = new Event();
            $res->event_title=$request->input('event_title');
            
            $res->status=$request->input('status');
            $res->created_at=date('Y-m-d h:i:s');
    
            $res->save();
            
        }
        
        $res=Event::find($request->input('id'));
        

         // Set a success message in the session
         session()->flash('success', 'Event saved successfully');
        
         return redirect('eventlist/'.$res->user_id);


    }


    public function eventstatuschange(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Event::find($request->input('id'));
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
    
            $res = new Event();
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

    public function destroy(Event $event,Request $request)
    {   

        $id=$request->id;
        Event::destroy(array('id',$id));
        return;
    }

    public function selecteddestroy(Event $event,Request $request){
        foreach($request->items as $item){
            Event::destroy(array('id',$item));
        }
        return;
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class Announcement extends Controller
{
    public function index(Request $request){

        $data['user_id'] = $request->user_id;
        $data['event_id'] =  "";
        $data['page'] = "Announcement";
        return view('announcement/announcementlist',$data);
    }

   

    public function getannouncementlistdata(Request $request){


        $query = DB::table('tbl_Announcement');
        
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


    public function announcementedit(Request $request){

        $data['title']="Announcement Edit";
        $data['fetched']=Announcement::find($request->id);
        return view( 'Announcement/eventadd', $data);

    }

    public function create(){

        $data['title']="Announcement Create";

        return view( 'Announcement/eventadd',$data);
    }


    public function Announcementsave(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Announcement::find($request->input('id'));

            $res->event_title=$request->input('event_title');
            $res->status=$request->input('status');
    
            $res->save();
    
        } else {
    
            $res = new Announcement();
            $res->event_title=$request->input('event_title');
            
            $res->status=$request->input('status');
            $res->created_at=date('Y-m-d h:i:s');
    
            $res->save();
            
        }
        
        $res=Announcement::find($request->input('id'));
        

         // Set a success message in the session
         session()->flash('success', 'Event saved successfully');
        
         return redirect('eventlist/'.$res->user_id);


    }


    public function Announcementtatuschange(Request $request){
        

        if ($request->input('id') != "") {
           
            $res=Announcement::find($request->input('id'));
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
    
            $res = new Announcement();
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

    public function destroy(Announcement $announcement,Request $request)
    {   

        $id=$request->id;
        Announcement::destroy(array('id',$id));
        return;
    }

    public function selecteddestroy(Announcement $announcement,Request $request){
        foreach($request->items as $item){
            Announcement::destroy(array('id',$item));
        }
        return;
    }
}

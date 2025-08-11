<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class GuestController extends Controller
{
    


    public function index(Request $request){
        $data['title']="Guest Book";
        $data['user_id'] = $request->user_id;
        $data['event_id'] =  "";
        $data['page'] = "guest";

        
        $url = request()->fullUrl();

        Session::put('redirectionurl', $url);

        return view( 'guest/guestlist',$data);
    }

    public function guestlistbyeventid(Request $request){

        $data['title']="Guest Book";
        $data['user_id'] = $request->user_id;
        $data['event_id'] = $request->event_id ?? "";
        $data['page'] = "guest";

        $url = request()->fullUrl();

        Session::put('redirectionurl', $url);

        
   
        return view( 'guest/guestlist',$data);
    }

    public function getguestlistdata(Request $request){


        $query = DB::table('tbl_guest');
        $query->select('tbl_guest.*', 'tbl_events.event_title', 'tbl_prefix.name as prefname');
        // Apply ordering
        $query->orderBy('tbl_guest.id', 'desc');
        $query->leftjoin('tbl_events', 'tbl_guest.event_id', '=', 'tbl_events.id');
        $query->leftjoin('tbl_prefix', 'tbl_guest.prefix_name', '=', 'tbl_prefix.id');
        if($request->user_id){
            $query->where('tbl_guest.user_id', '=',$request->user_id);
        }
        if($request->event_id){
            $query->where('tbl_guest.event_id', '=',$request->event_id);
        }


        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
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
                                    <a href="' . url('guestedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                  
                                  
                                </div>';
            })
           
            ->editColumn('name', function ($row) {

                
                    return $row->prefname.' '.$row->name;
                
                
            })
             // Status column with badge
            // ->editColumn('status', function ($row) {

            //     if($row->status==1){
            //         return '<div class="form-check form-switch">
            //                 <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

            //             </div>';
            //     }else{

            //         return '<div class="form-check form-switch">
            //             <input class="form-check-input toggle-switch" type="checkbox" role="switch" data-id="' . $row->id.'" >

            //         </div>';

            //     }
                
            // })
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'name', 'action'])
            ->make(true);


    }


    public function guestedit(Request $request){

        $data['title']="Guest Edit";
        $data['fetched']=DB::table('tbl_guest')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_events')->get();
        $data['prefix']= DB::table('tbl_prefix')->get();
        $data['guest_type']= DB::table('tbl_guest_type')->get();
        return view( 'guest/guestadd', $data);

    }

    public function create(){

        $data['title']="Guest Create";
       
        return view( 'state/stateadd',$data);
    }


    public function guestsave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_guest')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'prefix_name' => $request->input('prefix_id'),
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'category_id' => $request->input('category_id'),
                'special_tag' => $request->input('special_tag'),
            ]);
    
    
        } else {
    
            DB::table('tbl_guest')->insert([
                'prefix_name' => $request->input('prefix_id'),
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'category_id' => $request->input('category_id'),
                'special_tag' => $request->input('special_tag'),
            ]);
            
        }
         
         session()->flash('success', 'Guest saved successfully');
        
        //  return redirect('guestlist/'.$request->input('user_id'));


         $redirectUrl = Session::get('redirectionurl');

         // Forget session before redirection
         Session::forget('redirectionurl');
 
         return redirect($redirectUrl);




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

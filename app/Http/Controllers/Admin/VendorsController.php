<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Nette\Utils\Json;

class VendorsController extends Controller
{
    public function index(){
        $data['title']="Vendor";
        return view('admin/vendors/vendorslist',$data);
    }


    public function vendorlistbyeventid(Request $request){

        $data['title']="Vendor List";
        $data['user_id'] = $request->user_id;
        $data['event_id'] = $request->event_id ?? "";
        $data['page'] = "vendor";
        $data['pageroute']="1";

        $url = request()->fullUrl();

        Session::put('redirectionurl', $url);

        return view( 'events/vendorlist',$data);
    }

    public function vendorlistbyuserid(Request $request){

        $data['title']="Vendor List";
        $data['user_id'] = $request->user_id;
        $data['event_id'] = $request->event_id ?? "";
        $data['page'] = "vendor";
        $data['pageroute']="vendorlistbyuserid";

        $url = request()->fullUrl();

        Session::put('redirectionurl', $url);

        

       

        return view( 'events/vendorlist',$data);
    }

    public function getvendorlistdata(Request $request){

    
        

        $query = DB::table('tbl_vendors');

        // $query->select('tbl_vendors.*');
        
        // Apply ordering
        $query->orderBy('id', 'desc');
        // $query->leftjoin('tbl_events', 'tbl_vendors.event_id', '=', 'tbl_events.id');

        if($request->user_id){
            $query->where('tbl_vendors.user_id', '=',$request->user_id);
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
                                    <a href="' . url('vendoredit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
            ->editColumn('status', function ($row) {

                if($row->status==1){
                    return '<div class="form-check form-switch">
                            <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" checked>

                        </div>';
                }else{

                    return '<div class="form-check form-switch">
                        <input class="form-check-input toggle-switch statuschange" type="checkbox" role="switch" data-id="' . $row->id.'" >

                    </div>';

                }
                
            })
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'status', 'action'])
            ->make(true);


    }

    


    public function vendoredit(Request $request){

        $data['title']="vendor Edit";
        $data['fetched']=DB::table('tbl_vendors')->where('id','=',$request->id)->first();
        // $data['events'] =$events= DB::table('tbl_events')->get();
        
     
        // $data['states']= DB::table('tbl_states')->get();
        return view( 'admin/vendors/vendoradd', $data);

    }

    public function create(){

        $data['title']="vendor Create";
        // $data['events']= DB::table('tbl_events')->get();
        return view('admin/vendors/vendoradd',$data);
    }


    public function vendorsave(Request $request){
        
        // echo Session::get('redirectionurl');
        // die;

        // Handle file uploads for rera_certificate, real_estate_certificate, pancard
        $rera_certificate = null;
        $real_estate_certificate = null;
        $pancard = null;

        if ($request->hasFile('rera_certificate')) {
            $file = $request->file('rera_certificate');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $rera_certificate = time() . '_rera.webp';
            $path = public_path('uploads/vendors/' . $rera_certificate);

            // Convert and save to webp
            imagewebp($image, $path, 80); // 80 = quality
            imagedestroy($image);
        } else {
            $rera_certificate = $request->input('old_rera_certificate');
        }

        if ($request->hasFile('real_estate_certificate')) {
            $file = $request->file('real_estate_certificate');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $real_estate_certificate = time() . '_realestate.webp';
            $path = public_path('uploads/vendors/' . $real_estate_certificate);

            imagewebp($image, $path, 80);
            imagedestroy($image);
        } else {
            $real_estate_certificate = $request->input('old_real_estate_certificate');
        }

        if ($request->hasFile('pancard')) {
            $file = $request->file('pancard');
            $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

            $pancard = time() . '_pancard.webp';
            $path = public_path('uploads/vendors/' . $pancard);

            imagewebp($image, $path, 80);
            imagedestroy($image);
        } else {
            $pancard = $request->input('old_pancard');
        }

        if ($request->input('id') != "") {
           
            DB::table('tbl_vendors')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'area' => $request->input('area'),
                'pincode' => $request->input('pincode'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'landmark' => $request->input('landmark'),
                'rera_certificate' => $rera_certificate,
                'pancard' => $pancard,
                'real_estate_certificate' => $real_estate_certificate,
                'status' =>$request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_vendors')->insert([
                 'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'area' => $request->input('area'),
                'pincode' => $request->input('pincode'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'landmark' => $request->input('landmark'),
                 'rera_certificate' => $rera_certificate,
                'pancard' => $pancard,
                'real_estate_certificate' => $real_estate_certificate,
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'vendor saved successfully');
        
        
         return redirect('vendorlist');



    }


    public function vendorstatuschange(Request $request){
        

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
        DB::table('tbl_vendors')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_vendors')->where('id', $item)->delete();
        }
        return;
    }

}

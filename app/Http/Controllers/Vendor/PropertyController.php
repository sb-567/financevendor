<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Str;

use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;

class PropertyController extends Controller
{
    public function index(){
        $data['title']="Property";
        $data['vendors']= DB::table('tbl_vendors')->get();
         
        return view('vendor/property/property',$data);
    }




    public function getpropertylistdata(Request $request){

    
         $vendor_id = session('vid');

        $query = DB::table('tbl_properties')
            ->select('tbl_properties.*', );
            // ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_leads.vendor_id')
            // ->orderBy('tbl_leads.id', 'desc');

        // if ($request->vendor_id) {
            // $query->where('tbl_leads.vendor_id', $vendor_id);
        // }


        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_properties.property_name', 'like', "%{$keyword}%");
                        $q->orWhere('tbl_properties.city', 'like', "%{$keyword}%");
                        $q->orWhere('tbl_properties.area', 'like', "%{$keyword}%");
                        $q->orWhere('tbl_properties.pincode', 'like', "%{$keyword}%");
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
                        
                                    <a href="' . route('vendors.propertiesedit', ['id' => $row->id]) . '" class="btn btn-sm btn-primary me-2"> Edit </a>
                                    <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
                                  
                                </div>';
            })
            // Status column with badge
            ->editColumn('created_at', function ($row) {
                return date('d-m-Y h:i a', strtotime($row->created_at));
            })
            ->editColumn('price_type', function ($row) {
                
                 if($row->price_type==1){
                            $status = 'Rent';
                         
                        } elseif($row->price_type==2){ 
                            $status = 'Sale';
                         
                        }else{
                            $status = 'Lease';
                        }
                        return $status;


            })
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox','created_at','price_type', 'action'])
            ->make(true);


    }

    


    public function propertiesedit(Request $request){

        $data['title']="Property Edit";
        $data['fetched']=DB::table('tbl_properties')->where('id','=',$request->id)->first();
        
        
    //  $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view( 'vendor/property/propertyadd', $data);

    }

    public function create(){

        $data['title']="Property Create";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('vendor/property/propertyadd',$data);
    }


   public function propertiessave(Request $request)
    {
        $vendor_id = session('vid');

        $request->validate([
            'property_name'   => 'required',
            'pincode' => 'required',
    
        ]);

        // Handle images
        $property_images = [];

        if ($request->hasFile('property_images')) {
            foreach ($request->file('property_images') as $file) {
                if ($file->isValid()) {
                    $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

                    $filename = time() . '_' . uniqid() . '_property.webp';
                    $path = public_path('uploads/vendors/properties/' . $filename);

                    // Convert and save to webp
                    imagewebp($image, $path, 80);
                    imagedestroy($image);

                    $property_images[] = $filename;
                }
            }
        }

        // Merge old images if present
        $old_images = $request->input('old_property_images');
        if ($old_images) {
            $old_images = is_array($old_images) ? $old_images : json_decode($old_images, true);
            $property_images = array_merge($old_images, $property_images);
        }

        if ($request->input('id') != "") {
            // Update
            DB::table('tbl_properties')
                ->where('id', $request->input('id'))
                ->update([
                    'property_name'        => $request->input('property_name'),
                    // 'property_slug'        => Str::slug($request->input('property_name')),
                    'vendor_id'            => $vendor_id,
                    'status'               => $request->input('status'),
                    'facing_direction'     => $request->input('facing_direction'),
                    'apartment_type'       => $request->input('apartment_type'),
                    'no_of_bathroom'       => $request->input('no_of_bathroom'),
                    'parking_availability' => $request->input('parking_availability'),
                    'availability_status'  => $request->input('availability_status'),
                    'price_type'           => $request->input('price_type'),
                    'area'                 => $request->input('area'),
                    'pincode'              => $request->input('pincode'),
                    'city'                 => $request->input('city'),
                    'property_images'      => json_encode($property_images),
                    'updated_at'           => now()
                ]);
        } else {
            // Insert
            DB::table('tbl_properties')->insert([
                'property_name'        => $request->input('property_name'),
                'property_slug'        => Str::slug($request->input('property_name')),
                'vendor_id'            => $vendor_id,
                'status'               => $request->input('status'),
                'facing_direction'     => $request->input('facing_direction'),
                'apartment_type'       => $request->input('apartment_type'),
                'no_of_bathroom'       => $request->input('no_of_bathroom'),
                'parking_availability' => $request->input('parking_availability'),
                'availability_status'  => $request->input('availability_status'),
                'price_type'           => $request->input('price_type'),
                'area'                 => $request->input('area'),
                'pincode'              => $request->input('pincode'),
                'city'                 => $request->input('city'),
                'property_images'      => json_encode($property_images),
                'created_at'           => now(),
                'updated_at'           => now()
            ]);
        }

        session()->flash('success', 'Property saved successfully');
        return redirect()->route('vendors.propertieslist');
    }



    public function propertiesstatuschange(Request $request){
        

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
        DB::table('tbl_properties')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_properties')->where('id', $item)->delete();
        }
        return;
    }

}

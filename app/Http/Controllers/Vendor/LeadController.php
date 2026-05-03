<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;


class LeadController extends Controller
{

    public function index(){
        $data['title']="Lead";
        $data['vendors']= DB::table('tbl_vendors')->get();
         
        return view('vendor/lead/lead',$data);
    }




    public function getleadlistdata(Request $request){

    
         $vendor_id = session('vid');

        $query = DB::table('tbl_leads')
            ->select('tbl_leads.*', 'tbl_vendors.name as vendor_name', 'tbl_properties.property_name')
            ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_leads.vendor_id')
            ->leftJoin('tbl_properties', 'tbl_properties.id', '=', 'tbl_leads.property_id')
            ->orderBy('tbl_leads.id', 'desc');

        // if ($request->vendor_id) {
            $query->where('tbl_leads.vendor_id', $vendor_id);
        // }


        // Return DataTable response
        $dataTable = DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_leads.name', 'like', "%{$keyword}%");

                        $q->orWhere('tbl_leads.phone', 'like', "%{$keyword}%");
                        $q->orWhere('tbl_leads.email', 'like', "%{$keyword}%");
                    });
                }
            });

            if(Session::get('role_id')!=1){
                 if(empty(getcurrentsubcription())){
                    $dataTable->editColumn('name', function ($row) {
                        $name = trim($row->name);

                        if (strlen($name) <= 2) {
                            return $name;
                        }

                        return substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
                    });
                    $dataTable->editColumn('phone', function ($row) {
                        $phone = $row->phone;
                        return substr($phone, 0, 2) . '******' . substr($phone, -2);
                    });
                    $dataTable->editColumn('email', function ($row) {
                        $email = $row->email;
                        $parts = explode('@', $email);
                        return substr($parts[0], 0, 2) . '****@' . $parts[1];
                    });
                 }
            }
            
            // Checkbox column
            $dataTable->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkBox_' . $row->id . '" value="' . $row->id . '">
                            <label class="custom-control-label" for="checkBox_' . $row->id . '"></label>
                        </div>';
            });
            // Action column
            $dataTable->addColumn('action', function ($row) {
                    if($row->lead_type == 0){
                        $message = "Name: {$row->name}
                                    Email: {$row->email}
                                    Phone: {$row->phone}
                                    Area: {$row->area_name}
                                    City: {$row->city_name}
                                    Local Area: {$row->local_area_name}";
                    } else {
                        $message = "Name: {$row->name}
                                    Email: {$row->email}
                                    Phone: {$row->phone}
                                    Property Name: {$row->property_name}
                                    Area: {$row->area_name}
                                    City: {$row->city_name}
                                    Local Area: {$row->local_area_name}";  
                    }
                        return '<div class="d-flex">
                                    <a href="https://wa.me/'.$row->phone.'?text='.urlencode($message).'" target="_blank" class="btn btn-sm btn-success me-2"> Whatsapp </a>
                        
                       
                                    <button type="button" onclick="viewdata(' . $row->id.')"  class="btn btn-sm btn-primary me-2"> View</button>
                                 
                                </div>';
                        // <a href="' . route('vendors.leadedit', ['id' => $row->id]) . '" class="btn btn-sm btn-primary me-2"> Edit </a>
                                    // <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button>
            });
            // Status column with badge
            $dataTable->editColumn('created_at', function ($row) {
                return date('d-m-Y h:i a', strtotime($row->created_at));
            });
            $dataTable->editColumn('lead_type', function ($row) {
                return $row->lead_type == 0 ? 'Agent' : 'Property';
            });
    
            
         

            $dataTable->rawColumns(['checkbox','created_at', 'action']);
            return $dataTable->make(true);



    }

    


    public function leadedit(Request $request){

        $data['title']="Lead Edit";
        $data['fetched']=DB::table('tbl_leads')->where('id','=',$request->id)->first();
        
        
    //  $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view( 'vendor/lead/leadadd', $data);

    }

    public function create(){

        $data['title']="Lead Create";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('vendor/lead/leadadd',$data);
    }


    public function leadsave(Request $request){
        $vendor_id = session('vid');
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
         
            'status' => 'required',
        ]);

        if ($request->input('id') != "") {
           
            DB::table('tbl_leads')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'vendor_id' => $vendor_id,
                'status' =>$request->input('status'),
                'created_at' => now(),
                'updated_at' => now() 
            ]);
    
    
        } else {
    
            DB::table('tbl_leads')->insert([
                  'name' => $request->input('name'),
                'phone' => $request->input('mobile'),
                'email' => $request->input('email'),
                'vendor_id' => $vendor_id,
                'status' =>$request->input('status'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Lead saved successfully');
        
         return redirect()->route('vendors.agentlist');
         



    }


    public function leadstatuschange(Request $request){
        

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
        DB::table('tbl_leads')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_leads')->where('id', $item)->delete();
        }
        return;
    }


     public function leadview(Request $request){

        $data['title']="Lead View";
        $query=DB::table('tbl_leads as l')
                ->select('l.*','p.property_name')
                ->Leftjoin('tbl_properties as p', 'p.id', '=', 'l.property_id')
                ->where('l.id','=',$request->id);

                // Print SQL
//         $sql = $query->toSql();
// $bindings = $query->getBindings();

// // Replace ? with actual values
// $fullQuery = vsprintf(
//     str_replace('?', "'%s'", $sql),
//     $bindings
// );

// dd($fullQuery);
        // Execute after debugging
        $lead = $query->first();

        if (!$lead) {
            return response()->json([
                'success' => false,
                'message' => 'Lead not found'
            ]);
        }

        if(Session::get('role_id')!=1){
            if(empty(getcurrentsubcription())){
                // Apply masking
                    $lead->name   = $this->maskName($lead->name);
                    $lead->email  = $this->maskEmail($lead->email);
                    $lead->phone = $this->maskPhone($lead->phone);
                    
                    $lead->property_name = $lead->property_name;

                    if($lead->lead_type == 0){
                        $lead->lead_type   = 'Agent';
                    } else {
                        $lead->lead_type = 'Property';
                    }
                    
            }
        }
        return response()->json([
            'success' => true,
            'data' => $lead
        ]);
    }

    private function maskName($name)
    {
        $name = trim($name);

        if (strlen($name) <= 2) {
            return $name;
        }

        return substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
    }

    private function maskPhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (strlen($phone) < 6) {
            return $phone;
        }

        return substr($phone, 0, 2)
            . str_repeat('*', strlen($phone) - 4)
            . substr($phone, -2);
    }

    private function maskEmail($email)
    {
        if (!str_contains($email, '@')) {
            return $email;
        }

        [$user, $domain] = explode('@', $email);

        if (strlen($user) <= 2) {
            return $user . '@' . $domain;
        }

        return substr($user, 0, 2)
            . str_repeat('*', strlen($user) - 2)
            . '@' . $domain;
    }

    


    // public function export()
    // {
    //     return Excel::download(new LeadExport, 'leads.xlsx');
    // }
}

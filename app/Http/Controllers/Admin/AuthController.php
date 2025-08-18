<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\Models\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request){
        // Check if the user is already logged in
        if ($request->session()->has('uid')) {
            return redirect('dashboard'); // Redirect to dashboard if session is set
        }

        return view('admin.auth');

    }

    public function login(Request $request)
    {
         $username = $request->username;
         $password = $request->password;
   
        $user = Auth::where(function($query) use ($username) {
            $query->where('username', $username)
              ->orWhere('email', $username);
        })->first();

        if ($user && Hash::check($password, $user->password)) {
            
            $request->session()->put('user_id', $user->id);

            $otp = 1234; // Generate a random 4-digit OTP
            // $otp = rand(1000, 9999); // Generate a random 4-digit OTP
           
            Auth::where('id', $user->id)->update(['otp' => $otp]); 
            

            // $request->session()->put('role_id', $user->role_id);
            return redirect('verify');
        } else {
            
            session()->flash('error', 'Username or password does not match');
            return redirect('/');
        }
    }
    
    public function verify(Request $request)
    {
        
         if (!$request->session()->has('user_id')) {
            return redirect('/');
        }

        return view('admin.verify');
    }
    
    public function verifyotp(Request $request)
    {   
        // echo "ef";
        // die;
        if (!$request->session()->has('user_id')) {
            return redirect('/');
        }

         $uid = session('user_id');
         $otp = $request->otp1. $request->otp2 . $request->otp3 . $request->otp4;
   
        $user = Auth::where('id', $uid)->first();

        if ($user->otp==$otp) {
            
            $request->session()->put('uid', $user->id);
            $request->session()->put('role_id', $user->role_id);

            $request->session()->forget('user_id');
            return redirect('dashboard');
        } else {
            
            session()->flash('error', 'OTP does not match');
            return redirect('/');
        }
    }

    
    public function logout(Request $request)
    {
        $request->session()->forget('uid');
        $request->session()->forget('role_id');
        return redirect('/');
    }


    public function userlist()
    {
        $data['title'] = "User List";
        return view('admin.users.userslist', $data);
    }

    public function getuserlistdata(Request $request)
    {
        $query = DB::table('tbl_admin');
        
        // Apply ordering
        $query->orderBy('tbl_admin.id', 'desc');
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
                        $q->where('tbl_admin.name', 'like', "%{$keyword}%");
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
                                    <a href="' . url('useredit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
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
            ->editColumn('name', function ($row) {

                

                    return '<a href="' . url('eventlist/' . $row->id) . '">'.$row->name.'</a>';
                
                
                
            })
            
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns(['checkbox', 'name', 'status', 'action'])
            ->make(true);
    }


    public function useredit(Request $request){

        $data['title']="Users Edit";
        $data['fetched']=DB::table('tbl_admin')->where('id','=',$request->id)->first();
        $data['events']= DB::table('tbl_admin')->get();
        return view( 'users/usersadd', $data);

    }

    public function create(){

        $data['title']="Users Create";
        $data['role']= DB::table('tbl_roles')->get();
        return view( 'admin.users.usersadd',$data);
    }


    public function usersave(Request $request){
        

        if ($request->input('id') != "") {
           
            DB::table('tbl_admin')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' =>  Hash::make($request->input('password')), // Hash the password if provided
                'role_id' => $request->input('role_id'),
                'status' =>$request->input('status')
            ]);
    
    
        } else {
    
            DB::table('tbl_admin')->insert([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' =>  Hash::make($request->input('password')), // Hash the password if provided
                'role_id' => $request->input('role_id'),
                'status' =>$request->input('status')
            ]);
            
        }
         
         session()->flash('success', 'Users saved successfully');
        
         return redirect('userlist');


    }


    public function userstatuschange(Request $request){
        

        if ($request->filled('id')) { // Use filled() to check for non-empty values
            $vendor = DB::table('tbl_admin')->where('id', $request->input('id'))->first();
        
            if ($vendor) {
                DB::table('tbl_admin')
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
            $id = DB::table('tbl_admin')->insertGetId([
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
        DB::table('tbl_admin')->where('id', $id)->delete();
        return;

    }

    public function selecteddestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_admin')->where('id', $item)->delete();
        }
        return;
    }

}

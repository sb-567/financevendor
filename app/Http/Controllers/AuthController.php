<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request){
        // Check if the user is already logged in
        if ($request->session()->has('uid')) {
            return redirect('dashboard'); // Redirect to dashboard if session is set
        }

        return view('auth');

    }

    public function login(Request $request)
    {
         $username = $request->username;
         $password = $request->password;
   
        $user = Auth::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            
            $request->session()->put('uid', $user->id);
            return redirect('dashboard');
        } else {
            
            session()->flash('error', 'Username or password does not match');
            return redirect('/');
        }
    }

    
    public function logout(Request $request)
    {
        $request->session()->forget('uid');
        return redirect('/');
    }

}

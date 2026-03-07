<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Auth;

class WebGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(session()->has('uid')){
        //     return $next($request);
        // }else{
        //     return redirect('/');
        // }


        if (session()->has('uid')) {
            return $next($request);
        }else{
             return redirect('/')->with('error', 'Please login again. Session expired.');
        }

        
            $userId = session('uid');

            $user = Auth::select('id', 'is_password_reset')
                        ->where('id', $userId)
                        ->first();

            // If user not found or password reset flag = 1
            if (!$user || (int)$user->is_password_reset == 1) {

                session()->flush(); // destroy session

                return redirect('/')->with('error', 'Your password was reset. Please login again.');
            }

       



    }
}

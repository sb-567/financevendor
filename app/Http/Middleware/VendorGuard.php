<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorGuard
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

       

        if(session()->has('vid')){

            // if(checkvendorverify()){
            //     session()->flash('error', 'Please update your profile documents for verification.');
            //     return redirect()->route('vendors.profile');
            // }else{

                return $next($request);
            // }
        }else{
            // return redirect('/vendors');
            // return redirect(url('vendors'));
             return redirect()->route('vendors.login');
        }
    }
}

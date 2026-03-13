<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    

    public function index(){

        $data=[];
        $data['title']='Home';
        return view('website.home',$data);
    }


    public function aboutus(){
        $data['title']='About Us';
    return view('website.aboutus',$data);
    }
    public function contactus(){
         $data['title']='Contact Us';
    return view('website.contact',$data);
    }
    
    public function getproperties(){
         $data['title']='Properties List';
        return view('website.properties',$data);
    }
    
    public function getpropertydetail(){
         $data['title']='Properties Detail';
        return view('website.propertydetail',$data);
    }

    public function getblog(){
         $data['title']='Blog List';
        return view('website.blog',$data);
    }
    public function getblogdetail(){
         $data['title']='Blog Details';
        return view('website.blogdetail',$data);
    }
    
    
    
    
    
    public function getdisclaimer(){
         $data['title']='Disclaimer';
        return view('website.pages.disclaimer',$data);
    }
    public function getpolicy(){
         $data['title']='Privacy policy';
        return view('website.pages.policy',$data);
    }
    public function getrefund(){
         $data['title']='Refund';
        return view('website.pages.refund',$data);
    }

    public function getcookies(){
         $data['title']='Cookies';
        return view('website.pages.cookies',$data);
    }
    public function gettermsncondition(){
         $data['title']='Terms And Condition';
        return view('website.pages.terms',$data);
    }

}

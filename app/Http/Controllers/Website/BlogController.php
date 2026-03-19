<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogController extends Controller
{
    

     public function getblog(){
         $data['title']='Blog List';
        return view('website.blog',$data);
    }
    public function getblogdetail(){
         $data['title']='Blog Details';
        return view('website.blogdetail',$data);
    }
    


}

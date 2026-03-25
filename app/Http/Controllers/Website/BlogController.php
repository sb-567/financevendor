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
         $data['blogs']=DB::table('tbl_blogs')
         ->select('tbl_blogs.*','tbl_blog_categories.title as category')
         ->Leftjoin('tbl_blog_categories','tbl_blogs.category_id','=','tbl_blog_categories.id')
         ->where('tbl_blogs.status',1)
         ->orderBy('tbl_blogs.id','desc')->get();

        return view('website.blog',$data);
    }
    public function getblogdetail(){
         $data['title']='Blog Details';
        return view('website.blogdetail',$data);
    }
    


}

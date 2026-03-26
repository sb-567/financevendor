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


    public function getblogdetail(Request $request){
            $slug=$request->slug;

            $datas=DB::table('tbl_blogs')->where('slug',$slug)->first();
            
         $data['title']=$datas->blog_title;
         $data['blog']=$datas;

        return view('website.blogdetail',$data);
    }
    


}

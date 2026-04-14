<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogController extends Controller
{
    

   public function getblog(Request $request)
{
    $blogs = DB::table('tbl_blogs')
        ->select('tbl_blogs.*', 'tbl_blog_categories.title as category')
        ->leftJoin('tbl_blog_categories', 'tbl_blogs.category_id', '=', 'tbl_blog_categories.id')
        ->where('tbl_blogs.status', 1)
        ->orderBy('tbl_blogs.id', 'desc')
        ->paginate(6); // ✅ IMPORTANT

    // ✅ AJAX response
    if ($request->ajax()) {
        return view('website.partials.blog_data', compact('blogs'))->render();
    }

    return view('website.blog', [
        'title' => 'Blogs',
        'blogs' => $blogs
    ]);
}


    public function getblogdetail(Request $request){
         
         $slug=$request->slug;

         $datas=DB::table('tbl_blogs')->where('slug',$slug)->where('status', 1)->orderBy('id', 'desc')->first();


       



         $blogcategory=DB::table('tbl_blog_categories')->where('id',$datas->category_id)->first();
         $sideblogcategory=DB::table('tbl_blogs')->where('category_id',$datas->category_id)->where('status',1)->orderBy('id','desc')->limit(10)->get();
            
         $data['title']=$datas->blog_title;
         $data['blog']=$datas;
         $data['blogcategory']=$blogcategory;
         $data['relatedBlogs']=$sideblogcategory;

        return view('website.blogdetail',$data);
    }
    


}

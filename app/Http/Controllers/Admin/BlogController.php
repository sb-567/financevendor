<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
 

use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;


class Blogcontroller extends Controller
{

    public function index(){
        $data['title']="Blog Category";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        $data['slugdata']=getSubMenusbyslug('leadlist');

        return view('admin/blog/blogcategories',$data);
    }




    public function getblogcatgeorylistdata(Request $request){

       
        $query = DB::table('tbl_blog_categories')
            // ->select('tbl_leads.*', 'tbl_vendors.name as vendor_name')
            // ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_leads.vendor_id')
            ->orderBy('id', 'desc');

        // if ($request->vendor_id) {
        //     $query->where('tbl_leads.vendor_id', $request->vendor_id);
        // }


        // Return DataTable response
         $dataTable =  DataTables::of($query);
            // Filter by search term
             $dataTable->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('title', 'like', "%{$keyword}%");

                        // $q->orWhere('tbl_leads.phone', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_leads.email', 'like', "%{$keyword}%");
                    });
                }
            });
            
            // Checkbox column
             $dataTable->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkBox_' . $row->id . '" value="' . $row->id . '">
                            <label class="custom-control-label" for="checkBox_' . $row->id . '"></label>
                        </div>';
            });
            // Action column
             $dataTable->addColumn('action', function ($row) {
                    $btn="";
                   $slugdata=getSubMenusbyslug('blog');

                 if(getMenusWithPermissions($slugdata->id,'can_edit')){
                     $btn .= '<div class="d-flex">
                     <a href="' . url('admin/blogcategoryedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>';
                    
                 }
                     
                     if(getMenusWithPermissions($slugdata->id,'can_delete')){
    
                       $btn .='<button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button> </div>';
                     }


                     return $btn;
                                // <div class="d-flex">
                                //     <a href="' . url('leadedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                  
                                // </div>
            });
            // Status column with badge
             $dataTable->editColumn('created_at', function ($row) {
                return date('d-m-Y h:i a', strtotime($row->created_at));
            });

            $dataTable->editColumn('status', function ($row) {

                 if($row->status==1){
                    return '<span class="badge rounded-pill bg-success">Active</span>';
                }else{
                    return '<span class="badge rounded-pill bg-danger">Inactive</span>';
                }
                
            });
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            $dataTable->rawColumns(['checkbox','created_at', 'status', 'action']);
            return $dataTable->make(true);


    }

    


    public function blogcategoryedit(Request $request){

        $data['title']="BLog Edit";
        $data['fetched']=DB::table('tbl_blog_categories')->where('id','=',$request->id)->first();
        
        
        // $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view('admin/blog/blogcategoryadd',$data);

    }

   

    public function blogcategorycreate(){

        $data['title']="Blog Category Create";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        return view('admin/blog/blogcategoryadd',$data);
    }


    public function blogcategorystore(Request $request){
        
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);

        if ($request->input('id') != "") {
           
            DB::table('tbl_blog_categories')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'updated_at' => now() 
            ]);
    
    
        } else {
    
            DB::table('tbl_blog_categories')->insert([
                'title' => $request->input('title'),
                'status' =>$request->input('status'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Blog Catgeory saved successfully');
        
        
         return redirect('admin/blog/blogcategorylist');



    }



    public function blogcategorydestroy(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_blog_categories')->where('id', $id)->delete();
        return;

    }

    public function selectedblogcategorydestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_blog_categories')->where('id', $item)->delete();
        }
        return;
    }




    public function blogdetaillist(){
      $data['title']="Blog Detail";
        // $data['vendors']= DB::table('tbl_vendors')->get();
        $data['slugdata']=getSubMenusbyslug('blogdetaillist');

        return view('admin/blog/blogdetaillist',$data); 
    }



    public function getblogdetaillistdata(Request $request){

       
        $query = DB::table('tbl_blogs')
            ->select('tbl_blogs.*', 'tbl_blog_categories.title')
            ->leftJoin('tbl_blog_categories', 'tbl_blog_categories.id', '=', 'tbl_blogs.category_id')
            ->orderBy('tbl_blogs.id', 'desc');

        // if ($request->vendor_id) {
        //     $query->where('tbl_leads.vendor_id', $request->vendor_id);
        // }

        
        // Return DataTable response
         $dataTable =  DataTables::of($query);
            // Filter by search term
             $dataTable->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('tbl_blogs.blog_title', 'like', "%{$keyword}%");

                        $q->orWhere('tbl_blog_categories.title', 'like', "%{$keyword}%");
                        // $q->orWhere('tbl_leads.email', 'like', "%{$keyword}%");
                    });
                }
            });
            
            // Checkbox column
             $dataTable->addColumn('checkbox', function ($row) {
                return '<div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkBox_' . $row->id . '" value="' . $row->id . '">
                            <label class="custom-control-label" for="checkBox_' . $row->id . '"></label>
                        </div>';
            });
            // Action column
             $dataTable->addColumn('action', function ($row) {
            
                   $slugdata=getSubMenusbyslug('blog');
                    $btn="";
                     if(getMenusWithPermissions($slugdata->id,'can_edit')){
                     $btn .='<div class="d-flex"><a href="' . url('admin/blogdetailedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>';                     
                     }
                     
                     if(getMenusWithPermissions($slugdata->id,'can_delete')){
                        $btn .='<button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button></div>';
                     }
                                // <div class="d-flex">
                                //     <a href="' . url('leadedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                //     <button type="button" onclick="deleted(' . $row->id.')"  class="btn btn-sm btn-danger me-2"> Delete</button
                                  
                                // </div>

                                return $btn;
            });
            // Status column with badge
             $dataTable->editColumn('created_at', function ($row) {
                return date('d-m-Y h:i a', strtotime($row->created_at));
            });

            $dataTable->editColumn('status', function ($row) {

                 if($row->status==1){
                    return '<span class="badge rounded-pill bg-success">Active</span>';
                }else{
                    return '<span class="badge rounded-pill bg-danger">Inactive</span>';
                }
                
            });
    
            
            
            // Ensure HTML columns are rendered as raw HTML
            $dataTable->rawColumns(['checkbox','created_at', 'status', 'action']);
            return $dataTable->make(true);


    }




    public function blogdetailcreate(){

        $data['title']="Blog Detail Create";
        $data['blogcategory']= DB::table('tbl_blog_categories')->where('status',1)->get();
        return view('admin/blog/blogdetailadd',$data);
    }


    public function blogdetailstore(Request $request){
        
        $request->validate([
            'blog_title' => 'required',
            'status' => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        

        $imageName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

              if (!$file->isValid()) {
                    return back()
                        ->with('error', 'Invalid image upload')
                        ->withInput();
              }


            // Create image resource (GdImage)
            $imageResource = imagecreatefromstring(file_get_contents($file->getRealPath()));

            if ($imageResource === false) {
                throw new Exception('Invalid image file');
            }

            // Generate filename
            $imageName = time() . '.webp';

            // सही path
            $destinationPath = public_path('uploads/blog/' . $imageName);

            // Convert to webp
            imagewebp($imageResource, $destinationPath, 80);

            // Free memory
            imagedestroy($imageResource);

        } else {
            $imageName = $request->input('old_image');
        }
        if ($request->input('id') != "") {
           
            DB::table('tbl_blogs')
            ->where('id', $request->input('id')) // Make sure to specify the correct ID or condition
            ->update([
                'blog_title' => $request->input('blog_title'),
                'category_id' => $request->input('category_id'),
                'image' => $imageName,
                'description' =>$request->input('description'),
                'status' =>$request->input('status'),
                'image_alt' =>$request->input('image_alt'),
                'meta_title' =>$request->input('meta_title'),
                'meta_description' =>$request->input('meta_description'),
                'updated_at' => now() 
            ]);
    
    
        } else {

            $slug=Str::slug($request->input('blog_title'));

            DB::table('tbl_blogs')->insert([
                'blog_title' => $request->input('blog_title'),
                'slug' => $slug,
                'category_id' =>$request->input('category_id'),
                'image' => $imageName,
                'description' =>$request->input('description'),
                'status' =>$request->input('status'),
                'image_alt' =>$request->input('image_alt'),
                'meta_title' =>$request->input('meta_title'),
                'meta_description' =>$request->input('meta_description'),
                'created_at' => now(),
            ]);
            
        }
         
         session()->flash('success', 'Blog detail saved successfully');
        
        
         return redirect('admin/blog/blogdetaillist');



    }


    public function blogdetailedit(Request $request){

        $data['title']="BLog Detail Edit";
        $data['blogcategory']= DB::table('tbl_blog_categories')->where('status',1)->get();
        $data['fetched']=DB::table('tbl_blogs')->where('id','=',$request->id)->first();
        
        
        // $data['vendors']= DB::table('tbl_vendors')->get();
        // $data['states']= DB::table('tbl_states')->get();
        return view('admin/blog/blogdetailadd',$data);

    }



    public function blogdetaildestroy(Request $request)
    {   

        $id = $request->id;
        DB::table('tbl_blogs')->where('id', $id)->delete();
        return;

    }


        public function selectedblogdetaildestroy(Request $request){
        foreach($request->items as $item){
            // Subevent::destroy(array('id',$item));
            DB::table('tbl_blogs')->where('id', $item)->delete();
        }
        return;
    }



    // public function export()
    // {
    //     return Excel::download(new LeadExport, 'leads.xlsx');
    // }
}

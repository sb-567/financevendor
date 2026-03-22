@extends('admin.master')
@section('title',''.$title)

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">{{ ucfirst($title) }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">{{ ucfirst($title) }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
         


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ ucfirst($title) }}</h4>
                            
                        </div><!-- end card header -->
                        <div class="card-body">
                            
                            
                                 <form method="post" id="leadForm" action="{{route('admin.blogdetailsave')}}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                    <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select"  name="category_id" aria-label="Floating label select example">

                                                    @if(!empty($blogcategory))
                                                        <option value="">Select Blog Category</option>
                                                        @foreach($blogcategory as $bg)
                                                            <option value="{{$bg->id}}" @if(!empty($fetched->category_id) && $fetched->category_id==$bg->id){{"selected"}}@endif>{{$bg->title}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Blog Category Available</option>  
                                                    @endif

                                                    
                                                    
                                                </select>
                                                <label for="floatingSelect">Blog Category</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="blog_title" placeholder="Enter your title" value="@if(!empty($fetched->blog_title)){{$fetched->blog_title}}@endif" >
                                                <label for="firstnamefloatingInput">Title</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->status) && $fetched->status==1){{"selected"}}@endif>Active</option>
                                                        <option value="2"  @if(!empty($fetched->status) && $fetched->status==2){{"selected"}}@endif>Inactive</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Status</label>
                                            </div>
                                        </div>


                                           <div class="col-lg-12">
                                            
                                            <div class="mb-3">
                                                <label for="VertimeassageInput" class="form-label">Description</label>
                                                <textarea class="form-control tinymce" name="description" id="description" rows="3" placeholder="Enter your Description">@if(!empty($fetched->description)){{$fetched->description}}@endif</textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    
                                        
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="file" class="form-control" id="firstnamefloatingInput" name="image"  >
                                                <label for="firstnamefloatingInput">Image</label>
                                            </div>
                                        </div>
                                       

                                         <div class="col-lg-6">
                                            @if(!empty($fetched->image) && file_exists(public_path('uploads/blog/'.$fetched->image)))
                                                <img src="{{ asset('public/uploads/blog/'.$fetched->image) }}" alt="RERA Certificate" style="width: 200px; ">
                                                
                                                <input type="hidden" name="old_image" value="{{$fetched->image}}">
                                                @endif
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="image_alt" value="@if(!empty($fetched->image_alt)){{$fetched->image_alt}} @endif" >
                                                <label for="firstnamefloatingInput">Image Alt</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="meta_title" value="@if(!empty($fetched->meta_title)){{$fetched->meta_title}} @endif" >
                                                <label for="firstnamefloatingInput">Meta Title</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="meta_description" value="@if(!empty($fetched->meta_description)){{$fetched->meta_description}}@endif" >
                                                <label for="firstnamefloatingInput">Meta Description</label>
                                            </div>
                                        </div>
                                       
                                        


                                        
                                        
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>

        

    </div>
    <!-- container-fluid -->
</div>


@endsection

@section('customscript')

 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

<script>






tinymce.init({
    selector: '.tinymce',
    height: 300,

    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image',
        'charmap', 'preview', 'searchreplace',
        'code', 'fullscreen', 'media', 'table',
        'emoticons', 'wordcount'
    ],

    toolbar:
        'undo redo | blocks | bold italic underline | ' +
        'alignleft aligncenter alignright | bullist numlist | ' +
        'emoticons | image media table | code fullscreen',

    menubar: false,

    emoticons_database: 'emojis',   // full emoji set 😀
});



$(document).ready(function () {

    $("#leadForm").validate({
        rules: {
            category_id: {
                required: true
            },
            blog_title: {
                required: true,
                minlength: 3
            },
            status: {
                required: true
            },
            description: {
                required: true,
                minlength: 10
            },
            image: {
                extension: "jpg|jpeg|png|webp"
            },
            image_alt: {
                maxlength: 100
            },
            meta_title: {
                maxlength: 255
            },
            meta_description: {
                maxlength: 255
            }
        },

        messages: {
            category_id: {
                required: "Please select blog category"
            },
            blog_title: {
                required: "Please enter blog title",
                minlength: "Title must be at least 3 characters"
            },
            status: {
                required: "Please select status"
            },
            description: {
                required: "Please enter description",
                minlength: "Description must be at least 10 characters"
            },
            image: {
                extension: "Only JPG, PNG, JPEG, WEBP files allowed"
            },
            image_alt: {
                maxlength: "Max 100 characters allowed"
            },
            meta_title: {
                maxlength: "Max 255 characters allowed"
            },
            meta_description: {
                maxlength: "Max 255 characters allowed"
            }
        },

        errorElement: "span",
        errorClass: "text-danger",

        errorPlacement: function (error, element) {
            // 🔥 Fix for file input + tinymce
            if (element.attr("name") == "image") {
                error.insertAfter(element.closest('.form-floating'));
            } else if (element.attr("name") == "description") {
                error.insertAfter("#description");
            } else {
                error.insertAfter(element);
            }
        },

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        success: function (label, element) {
            $(element).addClass("is-valid");
        }
    });

});


</script>




@endsection


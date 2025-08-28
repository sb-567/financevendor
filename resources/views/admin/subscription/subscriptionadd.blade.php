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
                            
                            
                                 <form method="post" id="leadForm" action="{{url('/')}}/plandescriptionsave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-2">
                                    
                                    <div class="col-lg-7">

                                        <div class="row g-2">

                                        
                                            <div class="col-lg-6">
                                                <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="firstnamefloatingInput" name="title" placeholder="Enter your Title" value="@if(!empty($fetched->title)){{$fetched->title}}@endif" >
                                                    <label for="firstnamefloatingInput">Title</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="firstnamefloatingInput" name="price" placeholder="Enter your Price" value="@if(!empty($fetched->price)){{$fetched->price}}@endif" >
                                                    <label for="firstnamefloatingInput">Price</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="firstnamefloatingInput" name="cross_price" placeholder="Enter your Selling price" value="@if(!empty($fetched->cross_price)){{$fetched->cross_price}}@endif" >
                                                    <label for="firstnamefloatingInput">Selling Price</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="firstnamefloatingInput" name="offer_text" placeholder="Enter your Offer Text" value="@if(!empty($fetched->offer_text)){{$fetched->offer_text}}@endif" >
                                                    <label for="firstnamefloatingInput">Offer Text</label>
                                                </div>
                                            </div>
                                            
                                        
                                            <div class="col-lg-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                            <option value="1"  @if(!empty($fetched->status) && $fetched->status==1){{"selected"}}@endif>Active</option>
                                                            <option value="0"  @if(!empty($fetched->status) && $fetched->status==0){{"selected"}}@endif>Inactive</option>
                                                    </select>
                                                    <label for="floatingSelect">Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-lg-5">
                                        <div data-simplebar style="max-height: 300px;"> 
                                            <div class="list-group">
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Declined Payment
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="" checked>
                                                    Delivery Error
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="" checked>
                                                    Wrong Amount
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong Address
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                    Wrong UX/UI Solution
                                                </label>
                                            </div>
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

 


<script>
$(document).ready(function () {
    $("#leadForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
          
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "Name must be at least 3 characters long"
            },
       
            mobile: {
                required: "Please enter mobile number",
                digits: "Only numbers allowed",
                minlength: "Mobile must be 10 digits",
                maxlength: "Mobile must be 10 digits"
            },
            
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });
});
</script>




@endsection


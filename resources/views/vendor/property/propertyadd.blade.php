@extends('vendor.master')
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
                            
                            
                                 <form method="post" id="leadForm" action="{{ route('vendors.propertiessave') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                        <div class="col-lg-4">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="property_name" placeholder="Enter your Property Name" value="@if(!empty($fetched->property_name)){{$fetched->property_name}}@endif" >
                                                <label for="firstnamefloatingInput">Name</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="area" placeholder="Enter your Area" value="@if(!empty($fetched->area)){{$fetched->area}}@endif" >
                                                <label for="firstnamefloatingInput">Area</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="city" placeholder="Enter your City" value="@if(!empty($fetched->city)){{$fetched->city}}@endif" >
                                                <label for="firstnamefloatingInput">City</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="pincode" placeholder="Enter your Pincode" value="@if(!empty($fetched->pincode)){{$fetched->pincode}}@endif" >
                                                <label for="firstnamefloatingInput">Pincode</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="no_of_bathroom" placeholder="Enter your No Of Bathroom" value="@if(!empty($fetched->no_of_bathroom)){{$fetched->no_of_bathroom}}@endif" >
                                                <label for="firstnamefloatingInput">No Of Bathroom</label>
                                            </div>
                                        </div>

                                         <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="price_type" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->price_type) && $fetched->price_type==1){{"selected"}}@endif>Rent</option>
                                                        <option value="2"  @if(!empty($fetched->price_type) && $fetched->price_type==2){{"selected"}}@endif>Sale</option>
                                                        <option value="3"  @if(!empty($fetched->price_type) && $fetched->price_type==3){{"selected"}}@endif>Lease</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Price Type</label>
                                            </div>
                                        </div>
                                        
                                         <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="apartment_type" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->apartment_type) && $fetched->apartment_type==1){{"selected"}}@endif>1 RK</option>
                                                        <option value="2"  @if(!empty($fetched->apartment_type) && $fetched->apartment_type==2){{"selected"}}@endif>1 BHK</option>
                                                        <option value="3"  @if(!empty($fetched->apartment_type) && $fetched->apartment_type==3){{"selected"}}@endif>2 BHK</option>
                                                        <option value="4"  @if(!empty($fetched->apartment_type) && $fetched->apartment_type==4){{"selected"}}@endif>3 BHK</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Apartment Type</label>
                                            </div>
                                        </div>


                                         <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="parking_availability" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->parking_availability) && $fetched->parking_availability==1){{"selected"}}@endif>YES</option>
                                                        <option value="0"  @if(!empty($fetched->parking_availability) && $fetched->parking_availability==2){{"selected"}}@endif>NO</option>
                                                       
                                                    
                                                </select>
                                                <label for="floatingSelect">Parking Availability</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="availability_status" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->availability_status) && $fetched->availability_status==1){{"selected"}}@endif>YES</option>
                                                        <option value="0"  @if(!empty($fetched->availability_status) && $fetched->availability_status==2){{"selected"}}@endif>NO</option>
                                                       
                                                    
                                                </select>
                                                <label for="floatingSelect">Availability Status</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="facing_direction" placeholder="Enter your Room Facing direction" value="@if(!empty($fetched->facing_direction)){{$fetched->facing_direction}}@endif" >
                                                <label for="firstnamefloatingInput">Facing Direction</label>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="mobile" placeholder="Enter your Mobile" value="@if(!empty($fetched->phone)){{$fetched->phone}}@endif" >
                                                <label for="firstnamefloatingInput">Mobile</label>
                                            </div>
                                        </div> --}}
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->status) && $fetched->status==1){{"selected"}}@endif>Active</option>
                                                        <option value="2"  @if(!empty($fetched->status) && $fetched->status==2){{"selected"}}@endif>Inactive</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Status</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="file" class="form-control" id="firstnamefloatingInput" name="property_images[]" multiple>
                                            </div>
                                        </div>


                                        @if(!empty($fetched->property_images))
                                            @php
                                                $images = json_decode($fetched->property_images, true);
                                            @endphp
                                            @if(is_array($images))
                                                @foreach($images as $img)
                                                    @if(!empty($img) && file_exists(public_path('uploads/vendors/properties/'.$img)))
                                                        <div class="col-lg-3 position-relative mb-2">
                                                            <img class="preview img-fluid pt-2" src="{{ asset('public/uploads/vendors/properties/'.$img) }}" >
                                                            <input type="hidden" name="old_property_images[]" value="{{ $img }}">
                                                            <button type="button" class="btn btn-danger btn-sm  m-2 remove-image-btn" data-img="{{ $img }}" style="z-index:2;">Remove</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif

                                        


                                        
                                        
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
$(document).on('click', '.remove-image-btn', function() {
    $(this).closest('.col-lg-3').remove();

});
                                        
$(document).ready(function () {
    $("#leadForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            // mobile: {
            //     required: true,
            //     digits: true,
            //     minlength: 10,
            //     maxlength: 10
            // },
          
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "Name must be at least 3 characters long"
            },
       
            // mobile: {
            //     required: "Please enter mobile number",
            //     digits: "Only numbers allowed",
            //     minlength: "Mobile must be 10 digits",
            //     maxlength: "Mobile must be 10 digits"
            // },
            
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


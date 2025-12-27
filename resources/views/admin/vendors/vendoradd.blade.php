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
                            
                            
                                <form method="post" id="vendorForm" action="{{url('/')}}/vendorsave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="name" placeholder="Enter your Agent Name" value="@if(!empty($fetched->name)){{$fetched->name}}@endif" >
                                                <label for="firstnamefloatingInput">Agent Name</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="agent_business_name" placeholder="Enter your Agent Business Name" value="@if(!empty($fetched->agent_business_name)){{$fetched->agent_business_name}}@endif" >
                                                <label for="firstnamefloatingInput">Agent Business Name</label>
                                            </div>
                                        </div>

                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="business_type" aria-label="Floating label select example">

                                                        <option value="1"  @if(!empty($fetched->business_type) && $fetched->business_type==1){{"selected"}}@endif>Individual </option>
                                                        <option value="2"  @if(!empty($fetched->business_type) && $fetched->business_type==2){{"selected"}}@endif>Firm  </option>
                                                        <option value="3"  @if(!empty($fetched->business_type) && $fetched->business_type==3){{"selected"}}@endif>Company </option>
                                                        
                                                </select>
                                                <label for="floatingSelect">Business Type</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="firstnamefloatingInput" name="email" placeholder="Enter your Email" value="@if(!empty($fetched->email)){{$fetched->email}}@endif" >
                                                <label for="firstnamefloatingInput">Email</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="mobile" placeholder="Enter your Mobile" value="@if(!empty($fetched->phone)){{$fetched->phone}}@endif" >
                                                <label for="firstnamefloatingInput">Mobile</label>
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
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="sidezone" placeholder="Enter your Side Zone" value="@if(!empty($fetched->sidezone)){{$fetched->sidezone}}@endif" >
                                                <label for="firstnamefloatingInput">Side Zone</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="parentarea" placeholder="Enter your Parent Area" value="@if(!empty($fetched->parentarea)){{$fetched->parentarea}}@endif" >
                                                <label for="firstnamefloatingInput">Parent Area</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="micro_area_galli" placeholder="Enter your Micro Area / Galli" value="@if(!empty($fetched->micro_area_galli)){{$fetched->micro_area_galli}}@endif" >
                                                <label for="firstnamefloatingInput">Micro Area / Galli</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="service_area_covered" placeholder="Enter your Service Area Covered" value="@if(!empty($fetched->service_area_covered)){{$fetched->service_area_covered}}@endif" >
                                                <label for="firstnamefloatingInput">Service Area Covered</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                               <select class="form-select" id="floatingSelect" name="property_type" aria-label="Floating label select example">

                                                        <option value="1"  @if(!empty($fetched->property_type) && $fetched->property_type==1){{"selected"}}@endif>Residential </option>
                                                        <option value="2"  @if(!empty($fetched->property_type) && $fetched->property_type==2){{"selected"}}@endif>Commercial  </option>
                                                        <option value="3"  @if(!empty($fetched->property_type) && $fetched->property_type==3){{"selected"}}@endif>Both </option>
                                                        
                                                </select>
                                                <label for="floatingSelect">Property Type</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                               <select class="form-select" id="floatingSelect" name="transaction_type" aria-label="Floating label select example">

                                                        <option value="1"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==1){{"selected"}}@endif>Residential </option>
                                                        <option value="2"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==2){{"selected"}}@endif>Commercial  </option>
                                                        <option value="3"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==3){{"selected"}}@endif>Both </option>
                                                        
                                                </select>
                                                <label for="floatingSelect">Transaction Type</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="landmark" placeholder="Enter your Landmark" value="@if(!empty($fetched->landmark)){{$fetched->landmark}}@endif" >
                                                <label for="firstnamefloatingInput">Landmark</label>
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
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="city" placeholder="Enter your City" value="@if(!empty($fetched->city)){{$fetched->city}}@endif" >
                                                <label for="firstnamefloatingInput">City</label>
                                            </div>
                                        </div>
                                       
                                        
                                      
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="state" placeholder="Enter your State" value="@if(!empty($fetched->state)){{$fetched->state}}@endif" >
                                                <label for="firstnamefloatingInput">State</label>
                                            </div>
                                        </div>


                                       <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="admin_notes" placeholder="Enter your Admin Notes" value="@if(!empty($fetched->admin_notes)){{$fetched->admin_notes}}@endif" >
                                                <label for="firstnamefloatingInput">Admin Notes</label>
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
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="transaction_type" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==1){{"selected"}}@endif>Rent  </option>
                                                        <option value="2"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==2){{"selected"}}@endif>Sale </option>
                                                        <option value="3"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==3){{"selected"}}@endif>Both</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Transaction Type</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="subscription_type" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->subscription_type) && $fetched->subscription_type==1){{"selected"}}@endif>Free </option>
                                                        <option value="2"  @if(!empty($fetched->subscription_type) && $fetched->subscription_type==2){{"selected"}}@endif>Day Wise </option>
                                                        <option value="3"  @if(!empty($fetched->subscription_type) && $fetched->subscription_type==3){{"selected"}}@endif>Lead Wise</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Subscription Plan</label>
                                            </div>
                                        </div>


                                         <div class="col-lg-4">
                                            <div class="">
                                                <label for="firstnamefloatingInput">Rera Certificate</label>
                                                <input type="file" class="form-control" id="firstnamefloatingInput" name="rera_certificate" >
                                            </div>
                                            <div>
                                                @if(!empty($fetched->rera_certificate) && file_exists(public_path('uploads/vendors/'.$fetched->rera_certificate)))
                                                <img src="{{ asset('public/uploads/vendors/'.$fetched->rera_certificate) }}" alt="RERA Certificate" style="width: 200px; ">
                                                
                                                <input type="hidden" name="old_rera_certificate" value="{{$fetched->rera_certificate}}">
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-lg-4">
                                            <div class="">
                                                <label for="firstnamefloatingInput">Pancard</label>
                                                <input type="file" class="form-control" id="firstnamefloatingInput" name="pancard" >
                                            </div>
                                            <div>
                                                @if(!empty($fetched->pancard) && file_exists(public_path('uploads/vendors/'.$fetched->pancard)))
                                                    <img src="{{ asset('public/uploads/vendors/'.$fetched->pancard) }}" alt="pancard" style="width: 200px; ">
                                                    <input type="hidden" name="old_pancard" value="{{ $fetched->pancard }}">
                                                @endif
                                            </div>
                                        </div>
                                         <div class="col-lg-4">
                                            <div class="">
                                                <label for="firstnamefloatingInput">Real Estate Certificate</label>
                                                <input type="file" class="form-control" id="firstnamefloatingInput" name="real_estate_certificate" >
                                            </div>
                                            <div>
                                                @if(!empty($fetched->real_estate_certificate) && file_exists(public_path('uploads/vendors/'.$fetched->real_estate_certificate)))
                                                <img src="{{ asset('public/uploads/vendors/'.$fetched->pancard) }}" alt="RERA Certificate" style="width: 200px; ">
                                                
                                                <input type="hidden" name="old_real_estate_certificate" value="{{$fetched->real_estate_certificate}}">
                                                @endif
                                            </div>
                                        </div>


                                         <div class="col-lg-12">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="mb-3">
                                                <label for="VertimeassageInput" class="form-label">Message</label>
                                                <textarea class="form-control" name="admin_description" id="VertimeassageInput" rows="3" placeholder="Enter your message">@if(!empty($fetched->admin_description)){{$fetched->admin_description}}@endif</textarea>
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
    $("#vendorForm").validate({
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
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
      
            email: {
                required: true,
                email: true
            },
            area: "required",
            landmark: "required",
            city: "required",
            state: "required",
      
            @if(empty($fetched->id))
            
             rera_certificate: {
                 required: true,
                extension: "jpg|jpeg|png|webp|pdf"
            },
            pancard: {
                 required: true,
                extension: "jpg|jpeg|png|webp|pdf"
            },
            real_estate_certificate: {
                 required: true,
                extension: "jpg|jpeg|png|webp|pdf"
            }
              @endif
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "Name must be at least 3 characters long"
            },
            email: {
                required: "Please enter email",
                email: "Please enter a valid email"
            },
            mobile: {
                required: "Please enter mobile number",
                digits: "Only numbers allowed",
                minlength: "Mobile must be 10 digits",
                maxlength: "Mobile must be 10 digits"
            },
            area: "Please enter area",
            landmark: "Please enter landmark",
            pincode: {
                required: "Please enter pincode",
                digits: "Only numbers allowed",
                minlength: "Pincode must be 6 digits",
                maxlength: "Pincode must be 6 digits"
            },
            city: "Please enter city",
            state: "Please enter state",
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



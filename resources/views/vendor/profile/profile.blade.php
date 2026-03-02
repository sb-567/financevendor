@extends('vendor.master')
@section('title',''.$title)

@section('content')

<div class="page-content">
                <div class="container-fluid">

                    <div class="position-relative mx-n4 mt-n4">
                        <div class="profile-wid-bg profile-setting-img">
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content">
                                <div class="text-end p-3">
                                    <!-- <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                        <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                        </label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                   
                        <!--end col-->
                        <div class="col-xxl-12">
                            <div class="card mt-xxl-n5">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#description" role="tab">
                                                <i class="far fa-user"></i> Description
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="{{ route('vendors.updateprofile') }}" id="vendorForm" enctype="multipart/form-data" method="post">                                                   
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Agent Name</label>
                                                            <input type="text" class="form-control" name="name" id="firstnameInput" placeholder="Enter your Name" value="@if(!empty($fetched->name)){{$fetched->name}}@endif">
                                                            <input type="hidden" class="form-control" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Agent Business Name</label>
                                                            <input type="text" class="form-control" name="agent_business_name" id="firstnameInput" placeholder="Enter your Agent Business Name" value="@if(!empty($fetched->agent_business_name)){{$fetched->agent_business_name}}@endif">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Business Type</label>
                                                             <select class="form-select"  name="business_type" aria-label="Floating label select example">

                                                                    <option value="1"  @if(!empty($fetched->business_type) && $fetched->business_type==1){{"selected"}}@endif>Individual </option>
                                                                    <option value="2"  @if(!empty($fetched->business_type) && $fetched->business_type==2){{"selected"}}@endif>Firm  </option>
                                                                    <option value="3"  @if(!empty($fetched->business_type) && $fetched->business_type==3){{"selected"}}@endif>Company </option>
                                                                    
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Email</label>
                                                            <input type="text" class="form-control" name="email" id="firstnameInput" placeholder="Enter your Email" value="@if(!empty($fetched->email)){{$fetched->email}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Mobile</label>
                                                            <input type="text" class="form-control" name="mobile" id="firstnameInput" placeholder="Enter your Mobile" value="@if(!empty($fetched->phone)){{$fetched->phone}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Area</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="area" placeholder="Enter your Area" value="@if(!empty($fetched->area)){{$fetched->area}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                                <label for="firstnamefloatingInput">Parent Area</label>
                                                               <input type="text" class="form-control" id="firstnamefloatingInput" name="parentarea" placeholder="Enter your Parent Area" value="@if(!empty($fetched->parent_area)){{$fetched->parent_area}}@endif" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                                <label for="firstnamefloatingInput">Micro Area / Galli</label>
                                                               <input type="text" class="form-control" id="firstnamefloatingInput" name="micro_area_galli" placeholder="Enter your Micro Area / Galli" value="@if(!empty($fetched->micro_area_galli)){{$fetched->micro_area_galli}}@endif" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                                <label for="firstnamefloatingInput">Service Area Covered</label>
                                                               <input type="text" class="form-control" id="firstnamefloatingInput" name="service_area_covered" placeholder="Enter your Service Area Covered" value="@if(!empty($fetched->service_area_covered)){{$fetched->service_area_covered}}@endif" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="floatingSelect">Property Type</label>
                                                             <select class="form-select" id="floatingSelect" name="property_type" aria-label="Floating label select example">

                                                                    <option value="1"  @if(!empty($fetched->property_type) && $fetched->property_type==1){{"selected"}}@endif>Residential </option>
                                                                    <option value="2"  @if(!empty($fetched->property_type) && $fetched->property_type==2){{"selected"}}@endif>Commercial  </option>
                                                                    <option value="3"  @if(!empty($fetched->property_type) && $fetched->property_type==3){{"selected"}}@endif>Both </option>
                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="floatingSelect">Transaction Type</label>
                                                            <select class="form-select" id="floatingSelect" name="transaction_type" aria-label="Floating label select example">
                                                
                                                                    <option value="1"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==1){{"selected"}}@endif>Rent  </option>
                                                                    <option value="2"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==2){{"selected"}}@endif>Sale </option>
                                                                    <option value="3"  @if(!empty($fetched->transaction_type) && $fetched->transaction_type==3){{"selected"}}@endif>Both</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Landmark</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="landmark" placeholder="Enter your firstname" value="@if(!empty($fetched->landmark)){{$fetched->landmark}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">State</label>
                                                            <input type="text" class="form-control" name="state" id="firstnameInput" placeholder="Enter your State" value="@if(!empty($fetched->state)){{$fetched->state}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">City</label>
                                                            <input type="text" class="form-control" name="city" id="firstnameInput" placeholder="Enter your City" value="@if(!empty($fetched->city)){{$fetched->city}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Pincode</label>
                                                            <input type="number" class="form-control" name="pincode" id="firstnameInput" placeholder="Enter your Pincode" value="@if(!empty($fetched->pincode)){{$fetched->pincode}}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                <label for="floatingSelect">Signup Source</label>
                                                           <select class="form-select" id="floatingSelect" name="signup_source" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->signup_source) && $fetched->signup_source==1){{"selected"}}@endif>Admin </option>
                                                        <option value="2"  @if(!empty($fetched->signup_source) && $fetched->signup_source==2){{"selected"}}@endif>Field Executive </option>
                                                        <option value="3"  @if(!empty($fetched->signup_source) && $fetched->signup_source==3){{"selected"}}@endif>Website </option>
                                                        <option value="4"  @if(!empty($fetched->signup_source) && $fetched->signup_source==4){{"selected"}}@endif>Filed Executive</option>
                                                    
                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="rera_certificate" class="form-label">Rera Certificate</label>
                                                            <input type="file" class="form-control" name="rera_certificate" id="rera_certificate" >

                                                             @if(!empty($fetched->rera_certificate) && file_exists(public_path('uploads/vendors/'.$fetched->rera_certificate)))
                                                <img id="preview1" class="preview img-fluid pt-2" src="{{ asset('public/uploads/vendors/'.$fetched->rera_certificate) }}" alt="RERA Certificate" style="width: 200px; ">
                                                
                                                <input type="hidden" name="old_rera_certificate" value="{{$fetched->rera_certificate}}">
                                                @endif

                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="pancard" class="form-label">Pan Card</label>
                                                            <input type="file" class="form-control" name="pancard" id="pancard" >
                                                            
                                                              @if(!empty($fetched->pancard) && file_exists(public_path('uploads/vendors/'.$fetched->pancard)))
                                                    <img id="preview2" class="preview img-fluid pt-2" src="{{ asset('public/uploads/vendors/'.$fetched->pancard) }}" alt="pancard" style="width: 200px; ">
                                                    <input type="hidden" name="old_pancard" value="{{ $fetched->pancard }}">
                                                @endif

                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="real_estate_certificate" class="form-label">Real Estate Certificate</label>
                                                            <input type="file" class="form-control" name="real_estate_certificate" id="real_estate_certificate" >

                                                            @if(!empty($fetched->real_estate_certificate) && file_exists(public_path('uploads/vendors/'.$fetched->real_estate_certificate)))
                                                            <img id="preview3"   class="preview img-fluid pt-2"src="{{ asset('public/uploads/vendors/'.$fetched->real_estate_certificate) }}" alt="RERA Certificate" style="width: 200px; ">
                                                            
                                                            <input type="hidden" name="old_real_estate_certificate" value="{{$fetched->real_estate_certificate}}">
                                                            @endif
                                                            
                                                        </div>
                                                    </div>


                                                    
                                                    <!--end col-->
                                                
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Updates</button>
                                                            <!-- <button type="button" class="btn btn-soft-success">Cancel</button> -->
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->

                                        <div class="tab-pane" id="description" role="tabpanel">
                                            
                                        <p> @if(!empty($fetched->description)){{$fetched->description}}@endif </p>
                                            
                                        </div>


                                        <div class="tab-pane" id="changePassword" role="tabpanel">
                                            <form action="{{ route('vendors.changepassword') }}" id="vendorForm" enctype="multipart/form-data" method="post">                                                   
                                                @csrf
                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                            <input type="password" class="form-control" name="old_password" id="oldpasswordInput" placeholder="Enter current password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" name="new_password" id="newpasswordInput" placeholder="Enter new password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                            <input type="password" class="form-control" name="confirm_password" id="confirmpasswordInput" placeholder="Confirm password">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                            
                                        </div>
                                        <!--end tab-pane-->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->



@endsection

@section('customscript')

 

<script>
  function previewImage(inputId, previewId) {
    let input = document.getElementById(inputId);
    let preview = document.getElementById(previewId);

    input.addEventListener("change", function() {
      let file = this.files[0];
      if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
      } else {
        preview.src = ""; // reset if no file chosen
      }
    });
  }

  // Apply for all 3 file inputs
  previewImage("file1", "preview1");
  previewImage("file2", "preview2");
  previewImage("file3", "preview3");
</script>


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
            @if(empty($fetched->rera_certificate))
            rera_certificate: {
            required: true,
            extension: "jpg|jpeg|png|webp|pdf"
            },
            @endif
            @if(empty($fetched->pancard))
            pancard: {
            required: true,
            extension: "jpg|jpeg|png|webp|pdf"
            },
            @endif
            @if(empty($fetched->real_estate_certificate))
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


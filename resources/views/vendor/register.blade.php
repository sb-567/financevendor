<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">



<head>

    <meta charset="utf-8" />
    <title>Finance Vendor Listing Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body{
            background: url('{{asset("assets/images/loginbg.jpg")}}');
            background-size: cover;
    backdrop-filter: blur(1.1px);
        }
        .card{
            border-right: 2px solid #fe7b67;
            border-left: 2px solid #0ca27b;
            border-top: 2px solid #0ca27b;
            border-bottom: 2px solid #fe7b67;
        }
        
        </style>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <!-- <div class="bg-overlay"></div> -->
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="text-center ">
                            <img src="{{asset('assets/images/localagent.png')}}" width="190px" class="auth-logo img-fluid">
                        </div>
                        <div class="card overflow-hidden card-bg-fill galaxy-border-none">
                            <div class="row g-0">


                                <div class="col-lg-12">
                                    <div class="p-lg-5 p-4">
                                        
                                        <div>
                                            <h5 class="text-primary">Register Account</h5>
                                            <p class="text-muted">Get your Free account now.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form id="vendorForm" action="{{ route('vendors.vregistersave') }}" method="post">
                                                @csrf

                                                <div class="row">
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                                                        </div>
                                                   </div>

                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Email</label>
                                                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                                        </div>
                                                   </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Mobile No</label>
                                                            <input type="text" pattern="\d{10}" maxlength="10" minlength="10" class="form-control" name="mobile" placeholder="Enter Mobile No" title="Please enter a 10 digit mobile number">
                                                        </div>
                                                   </div>


                                                   <div class="col-md-4">

                                                   <div class="mb-3">
                                                        
                                                        <label class="form-label" for="password-input">Password</label>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password" id="password-input">
                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                    </div>

                                                   </div>


                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Area</label>
                                                            <input type="text" class="form-control" name="area" placeholder="Enter Area">
                                                        </div>
                                                   </div>
                                                   
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Landmark</label>
                                                            <input type="text" class="form-control" name="landmark" placeholder="Enter Landmark">
                                                        </div>
                                                   </div>
                                                   
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">City</label>
                                                            <input type="text" class="form-control" name="city" placeholder="Enter City">
                                                        </div>
                                                   </div>
                                                   
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">State</label>
                                                            <input type="text" class="form-control" name="state" placeholder="Enter State">
                                                        </div>
                                                   </div>
                                                   
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Pincode</label>
                                                            <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode">
                                                        </div>
                                                   </div>

                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Rera Certificate</label>
                                                            <input type="file" id="file1" class="form-control" name="rera_certificate" >

                                                            <img id="preview1" class="preview img-fluid pt-2" src="" alt="No image">

                                                        </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Pan Card</label>
                                                            <input type="file" id="file2" class="form-control" name="pincode" >

                                                             <img id="preview2" class="preview img-fluid pt-2" src="" alt="No image">

                                                        </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Real Estate Certificate</label>
                                                            <input type="file" id="file3" class="form-control" name="real_estate_certificate" >

                                                            <img id="preview3" class="preview img-fluid pt-2" src="" alt="No image">
                                                        </div>
                                                   </div>



                                                </div>

                                           

                                                    

                                                <!-- <div class="mb-3" id="otp-input">
                                                    <label for="username" class="form-label">Otp</label>
                                                    <input type="text" class="form-control"
                                                        name="otp"
                                                        placeholder="Enter Otp"
                                                        maxlength="4"
                                                        pattern="[0-9]{4}"
                                                        inputmode="numeric">
                                                </div> -->



                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                                </div>



                                            </form>
                                        </div>


                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- password-addon init -->
    <script src="{{asset('assets/js/pages/password-addon.init.js')}}"></script>

    <script>
        document.querySelector('input[name="otp"]').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 4);
        });

    </script>

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
      
                        
            //  rera_certificate: {
            //      required: true,
            //     extension: "jpg|jpeg|png|webp|pdf"
            // },
            // pancard: {
            //      required: true,
            //     extension: "jpg|jpeg|png|webp|pdf"
            // },
            // real_estate_certificate: {
            //      required: true,
            //     extension: "jpg|jpeg|png|webp|pdf"
            // }
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

</body>



</html>
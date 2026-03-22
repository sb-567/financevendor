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
                    {{-- @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                            
                            
                                <form method="post" id="userForm" action="{{route('admin.usersave')}}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="name" placeholder="Enter your Name" value="@if(!empty($fetched->name)){{$fetched->name}}@endif" >
                                                <label for="firstnamefloatingInput">Name</label>
                                            </div>
                                        </div>
                                        
                                        
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="username" placeholder="Enter your username" value="@if(!empty($fetched->username)){{$fetched->username}}@endif" >
                                                <label for="firstnamefloatingInput">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="email" placeholder="Enter your Email" value="@if(!empty($fetched->email)){{$fetched->email}}@endif" >
                                                <label for="firstnamefloatingInput">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="mobile" placeholder="Enter your Mobile" value="@if(!empty($fetched->mobile)){{$fetched->mobile}}@endif" >
                                                <label for="firstnamefloatingInput">Mobile</label>
                                            </div>
                                        </div>
                                        
                                    

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="role_id" aria-label="Floating label select example">
                                                        <option value="">Select Role</option>
                                                        @if(!empty($role))
                                                            @foreach ($role as $evt)
                                                                <option value="{{$evt->id}}"  @if(!empty($fetched->role_id) && $fetched->role_id==$evt->id){{"selected"}}@endif>{{ $evt->role_name}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="floatingSelect">Role</label>
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
                                                <input type="text" class="form-control"  id="passwordInput"  name="password" placeholder="Enter your password" >
                                                <label for="passwordInput">Password</label>


                                                                            
                                            </div>

                                            <div class="mt-2 d-flex gap-2">
                                                <button type="button"
                                                        class="btn btn-sm btn-primary"
                                                        onclick="generatePassword()">
                                                    🔑 Generate
                                                </button>

                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="clearPassword()">
                                                    🧹 Clear
                                                </button>
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
 function generatePassword() {
    const length = 12;
    const chars =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ" +   // A-Z
        "abcdefghijklmnopqrstuvwxyz" +   // a-z
        "0123456789" +                   // 0-9
        "!@#$%^&*()_+{}[]<>?";            // symbols

    let password = "";

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * chars.length);
        password += chars[randomIndex];
    }

    document.getElementById("passwordInput").value = password;
}

function clearPassword() {
    document.getElementById("passwordInput").value = "";
}



$(document).ready(function () {
    $("#userForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            username: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            role_id: {
                required: true
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "Name must be at least 3 characters long"
            },
            username: {
                required: "Please enter username",
                minlength: "Username must be at least 3 characters long"
            },
            email: {
                required: "Please enter email",
                email: "Please enter a valid email address"
            },
            role_id: {
                required: "Please select role"
            },
            mobile: {
                required: "Please enter mobile number",
                digits: "Only numbers allowed",
                minlength: "Mobile must be 10 digits",
                maxlength: "Mobile must be 10 digits"
            }
        },
        errorElement: "span",
        errorClass: "text-danger",

        // 🔥 Place error properly (important fix)
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        // ✅ Add valid class (optional but better UI)
        success: function (label, element) {
            $(element).addClass("is-valid");
        }
    });
});

</script>
@endsection
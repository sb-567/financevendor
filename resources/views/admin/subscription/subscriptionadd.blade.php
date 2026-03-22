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
                            
                            
                                 <form method="post" id="leadForm" action="{{route('admin.subscriptionplansave')}}"  enctype="multipart/form-data">
                                    @csrf
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
                                                    <select class="form-select" id="subscription_type" name="subscription_type" aria-label="Floating label select example">
                                                            <option value="1"  @if(!empty($fetched->subscription_type) && $fetched->subscription_type==1){{"selected"}}@endif>Day Wise</option>
                                                            <option value="2"  @if(!empty($fetched->subscription_type) && $fetched->subscription_type==2){{"selected"}}@endif>Lead Wsie</option>
                                                    </select>
                                                    <label for="subscription_type">Subscription Type</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6 no_of_leads_div" >
                                                
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="no_of_leads" name="no_of_leads" placeholder="Enter No Of Leads" value="@if(!empty($fetched->no_of_leads)){{$fetched->no_of_leads}}@endif" >
                                                    <label for="no_of_leads">No Of Leads</label>
                                                </div>



                                            </div>
                                            <div class="col-lg-6 time_duration_div">
                                                
                                           

                                                <div class="form-floating">
                                                    <select class="form-select" id="time_duration" name="time_duration" aria-label="Floating label select example">
                                                            <option value="15"  @if(!empty($fetched->time_duration) && $fetched->time_duration=='15'){{"selected"}}@endif>15 Days</option>
                                                            <option value="1 Months"  @if(!empty($fetched->time_duration) && $fetched->time_duration=='1 Months'){{"selected"}}@endif>1 Months</option>
                                                            <option value="1 Year"  @if(!empty($fetched->time_duration) && $fetched->time_duration=='1 Year'){{"selected"}}@endif>1 Year</option>
                                                    </select>
                                                    <label for="time_duration">Time Duration</label>
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

    // 🔥 Conditional validation based on subscription type
    $.validator.addMethod("checkLeads", function (value, element) {
        return $("#subscription_type").val() != "2" || value !== "";
    }, "Please enter number of leads");

    $.validator.addMethod("checkDuration", function (value, element) {
        return $("#subscription_type").val() != "1" || value !== "";
    }, "Please select time duration");

    $("#leadForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            },
            subscription_type: {
                required: true
            },
            no_of_leads: {
                digits: true,
                checkLeads: true
            },
            time_duration: {
                checkDuration: true
            },
            price: {
                required: true,
                number: true
            },
            cross_price: {
                 required: true,
                number: true
            },
            offer_text: {
                maxlength: 255
            },
            status: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter title",
                minlength: "Title must be at least 3 characters"
            },
            subscription_type: {
                required: "Please select subscription type"
            },
            no_of_leads: {
                digits: "Only numbers allowed"
            },
            time_duration: {
                required: "Please select time duration"
            },
            price: {
                required: "Please enter price",
                number: "Only numeric value allowed"
            },
            cross_price: {
                number: "Only numeric value allowed"
            },
            offer_text: {
                maxlength: "Max 255 characters allowed"
            },
            status: {
                required: "Please select status"
            }
        },

        errorElement: "span",
        errorClass: "text-danger",

        errorPlacement: function (error, element) {
            error.insertAfter(element);
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

    $('#subscription_type').on('change', function () {

    var type = $(this).val();
        console.log(type);
    if (type == 1) {
        $('.no_of_leads_div').hide();
        $('.time_duration_div').show();
    } 
    else if (type == 2) {
        $('.no_of_leads_div').show();
        $('.time_duration_div').hide();
    }
});
    // Trigger change event on page load to set the initial state
    $(document).ready(function() {
        $('#subscription_type').trigger('change');
    });



</script>




@endsection


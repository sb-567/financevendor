@extends('master')
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
                            
                            
                                <form method="post" action="{{url('/')}}/vendorsave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-4">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="name" placeholder="Enter your Name" value="@if(!empty($fetched->name)){{$fetched->name}}@endif" required>
                                                <label for="firstnamefloatingInput">Name</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="mobile" placeholder="Enter your Mobile" value="@if(!empty($fetched->mobile)){{$fetched->mobile}}@endif" required>
                                                <label for="firstnamefloatingInput">Mobile</label>
                                            </div>
                                        </div>
                                       
                                    

                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="event_id" name="event_id" aria-label="Floating label select example">
                                                        <option value="">Select Event</option>
                                                        @if(!empty($events))
                                                            @foreach ($events as $evt)
                                                                <option value="{{$evt->id}}"  @if(!empty($fetched->event_id) && $fetched->event_id==$evt->id){{"selected"}}@endif>{{ $evt->event_title}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="event_id">Events</label>
                                            </div>
                                        </div>

                                        
                                      


                                     

                                        <div class="col-md-12">
                                            @if(!empty($fetched->sub_event_id))
                                                <input type="hidden" id="old_sub_event_id" value="{{$fetched->sub_event_id}}" >

                                            @endif
                                 
                                           
                                            <label >Sub Events</label>
                                            <div class="scrollbar border border-1 border-primary p-2" >
                                                <div class="row " id="sub_event_id">
                                                  
                                                          
                                                        
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="task_id" aria-label="Floating label select example">
                                                        <option value="">Select Task</option>
                                                        @if(!empty($events))
                                                            @foreach ($events as $evt)
                                                                <option value="{{$evt->id}}"  @if(!empty($fetched->event_id) && $fetched->event_id==$evt->id){{"selected"}}@endif>{{ $evt->event_title}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="floatingSelect">Task</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <select class="form-select"  id="state_id" name="state_id"  aria-label="Floating label select example">
                                                        <option value="">Select State</option>
                                                        @if(!empty($states))
                                                            @foreach ($states as $state)
                                                                <option value="{{$state->id}}"  @if(!empty($fetched->state_id) && $fetched->state_id==$state->id){{"selected"}}@endif>{{ $state->state_title}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="floatingSelect">State</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                                 
                                            @if(!empty($fetched->district_id))
                                            <input type="hidden" id="old_district_id" value="{{$fetched->district_id}}" >

                                        @endif
                                            <div class="form-floating">
                                                <select class="form-select" id="district_id" name="district_id" aria-label="Floating label select example">
                                                        <option value="">Select District</option>
                                                      

                                                </select>
                                                <label for="floatingSelect">District</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            @if(!empty($fetched->sub_district_id))
                                            <input type="hidden" id="old_sub_district_id" value="{{$fetched->sub_district_id}}" >

                                        @endif
                                            <div class="form-floating">
                                                <select class="form-select" id="sub_district_id" name="sub_district_id" name="sub_district_id" aria-label="Floating label select example">
                                                        <option value="">Select Sub District</option>
                                                      

                                                </select>
                                                <label for="floatingSelect">Sub District</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="amount" placeholder="Enter your Amount" value="@if(!empty($fetched->amount)){{$fetched->amount}}@endif" required>
                                                <label for="firstnamefloatingInput">Amount</label>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="advance_amount" placeholder="Enter your Advance Amount" value="@if(!empty($fetched->advance_amount)){{$fetched->advance_amount}}@endif" required>
                                                <label for="firstnamefloatingInput">Advance Amount</label>
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


    $(document).ready(function(){
      
        $('#state_id').trigger('change');
        $('#event_id').trigger('change');
      
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });



    $('#event_id').change(function(){
        var event_id = $(this).val();
        $('#sub_event_id').empty();

        var old_sub_event_id = $('#old_sub_event_id').val();
        //alert(state_id);
        $.ajax({
            url: "{{url('/')}}/getsubeventbyid",
            type: "POST",
            data: {
                event_id: event_id,
                old_sub_event_id: old_sub_event_id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data){

                // console.log(data);
                
                $('#sub_event_id').html(data);
               
                        
                
                
            }
        });
    });



    $('#state_id').change(function(){
        var state_id = $(this).val();
        $('#district_id').empty();

        var old_district_id = $('#old_district_id').val();
        //alert(state_id);
        $.ajax({
            url: "{{url('/')}}/getdistrict",
            type: "POST",
            data: {
                state_id: state_id,
                old_district_id:old_district_id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data){
                $('#district_id').html(data);

                $('#district_id').trigger('change');
            }
        });
    });
    
    $('#district_id').change(function(){
        var district_id = $(this).val();
        $('#sub_district_id').empty();

        var old_sub_district_id = $('#old_sub_district_id').val();
        //alert(state_id);
        $.ajax({
            url: "{{url('/')}}/getsubdistrict",
            type: "POST",
            data: {
                district_id: district_id,
                old_sub_district_id:old_sub_district_id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data){
                $('#sub_district_id').html(data);
            }
        });
    });

</script>

@endsection



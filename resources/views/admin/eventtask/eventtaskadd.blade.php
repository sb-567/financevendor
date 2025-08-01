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
                            
                            
                                <form method="post" action="{{url('/')}}/usertasksave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-8">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="event_task_title" placeholder="Enter your task" value="@if(!empty($fetched->event_task_title)){{$fetched->event_task_title}}@endif" required>
                                                <label for="firstnamefloatingInput">Task</label>
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

                                        
                                      


                                     

                                        {{-- <div class="col-md-12">
                                            @if(!empty($fetched->subevent_id))
                                                <input type="hidden" id="old_sub_event_id" value="{{$fetched->subevent_id}}" >

                                            @endif
                                 
                                           
                                            <label >Sub Events</label>
                                            <div class="scrollbar border border-1 border-primary p-2" >
                                                <div class="row " id="sub_event_id">
                                                  
                                                          
                                                        
                                                </div>
                                            </div>
                                        </div> --}}
                                       
                                       
                                      

                                        
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




</script>

@endsection



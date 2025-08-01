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
                                                <select class="form-select" id="floatingSelect" name="event_id" aria-label="Floating label select example">
                                                        <option value="">Select Event</option>
                                                        @if(!empty($events))
                                                            @foreach ($events as $evt)
                                                                <option value="{{$evt->id}}"  @if(!empty($fetched->event_id) && $fetched->event_id==$evt->id){{"selected"}}@endif>{{ $evt->event_title}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="floatingSelect">Events</label>
                                            </div>
                                        </div>

                                        
                                       
                                        {{-- <div class="col-lg-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="sub_event_id" id="sub_event_id" aria-label="Floating label select example">
                                                        <option value="">Select Sub Event</option>
                                                        

                                                </select>
                                                <label for="floatingSelect">Events</label>
                                            </div>

                                            
                                        </div> --}}


                                     

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-multiple-remove-button" class="form-label text-muted">With remove button</label>
                                                <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                                    <option value="Choice 1" selected>Choice 1</option>
                                                    <option value="Choice 2" >Choice 2</option>
                                                    <option value="Choice 3" >Choice 3</option>
                                                    <option value="Choice 4" >Choice 4</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="task_id" aria-label="Floating label select example">
                                                        <option value="">Select Task</option>
                                                        @if(!empty($events))
                                                            @foreach ($events as $evt)
                                                                <option value="{{$evt->id}}"  @if(!empty($fetched->event_id) && $fetched->event_id==$evt->id){{"selected"}}@endif>{{ $evt->event_title}}</option>
                                                            @endforeach
                                                        @endif

                                                </select>
                                                <label for="floatingSelect">Events</label>
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


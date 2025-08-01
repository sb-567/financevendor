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
                            
                            
                                <form method="post" action="{{url('/')}}/tasksave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="task_title" placeholder="Enter your Task Title" value="@if(!empty($fetched->task_title)){{$fetched->task_title}}@endif" required>
                                                <label for="firstnamefloatingInput">Task Title</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                
                                                        <option value="1"  @if(!empty($fetched->status) && $fetched->status==1){{"selected"}}@endif>Active</option>
                                                        <option value="2"  @if(!empty($fetched->status) && $fetched->status==2){{"selected"}}@endif>Inactive</option>
                                                    
                                                </select>
                                                <label for="floatingSelect">Status</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 ">

                                            @if(!empty($fetched->states_id))

                                            @php
                                                $statesid=json_decode($fetched->states_id);
                                                

                                            @endphp


                                            @endif

                                            <div class="scrollbar border border-1 border-primary p-2" >
                                                <div class="row ">
                                                    @if(!empty($states))
                                                        @foreach ($states as $sat)
                                                            <div class="col-md-2">
                                                                <div class="boxcontent">
                                                                    <input type="checkbox" id="s{{ $sat->id }}" name="states_id[]" value="{{ $sat->id }}" @if(in_array($sat->id,$statesid)){{"checked"}}@endif>
                                                                    <label for="s{{ $sat->id }}">{{ $sat->state_title }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    
                                                
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


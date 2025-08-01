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
                            
                            
                                <form method="post" action="{{url('/')}}/guestsave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">





                                        <div class="col-lg-2">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" name="prefix_id" aria-label="Floating label select example">
                                                    
                                                    @If(!empty($prefix))
                                                        @foreach($prefix as $pre)
                                                            <option value="{{$pre->id}}" @if(!empty($fetched->prefix) && $fetched->prefix_name==$pre->id){{"selected"}}@endif>{{$pre->name}}</option>
                                                        @endforeach
                                                    @endif
                                                  
                                                </select>
                                                <label for="floatingSelect">Prefix</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <input type="hidden" name="user_id" value="@if(!empty($fetched->user_id)){{$fetched->user_id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="name" value="@if(!empty($fetched->name)){{$fetched->name}}@endif" required>
                                                <label for="firstnamefloatingInput">Name</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-5">
                                            
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="mobile" placeholder="Enter your mobile" value="@if(!empty($fetched->mobile)){{$fetched->mobile}}@endif" required>
                                                <label for="firstnamefloatingInput">Mobile</label>
                                            </div>
                                        </div>
                                        
                                

                                        <div class="col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="address" placeholder="Enter your Address" value="@if(!empty($fetched->address)){{$fetched->address}}@endif" required>
                                                <label for="firstnamefloatingInput">Address</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            
                                            <div class="form-floating">
                                               
                                                <select class="form-select" id="floatingSelect" name="category_id" aria-label="Floating label select example">
                                                    
                                                    @If(!empty($guest_type))
                                                        @foreach($guest_type as $pre)
                                                            <option value="{{$pre->id}}" @if(!empty($fetched->category_id) && $fetched->category_id==$pre->id){{"selected"}}@endif>{{$pre->name}}</option>
                                                        @endforeach
                                                    @endif
                                                  
                                                </select>
                                                <label for="floatingSelect">Category</label>


                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="special_tag" placeholder="Enter your Special Tag" value="@if(!empty($fetched->special_tag)){{$fetched->special_tag}}@endif">
                                                <label for="firstnamefloatingInput">Special Tags</label>
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


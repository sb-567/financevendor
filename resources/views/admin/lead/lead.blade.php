@extends('admin.master')
@section('title',''.$title)

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">{{ $title }} List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">{{$title}} List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$title}} List</h5>
                            
                        <div class="d-flex justify-content-between align-items-center mt-4">
                           

                            <form method="post" action="{{ route('admin.exportlead') }}" id="filterForm" enctype="multipart/form-data">
                                @csrf
                                                
                        @php
                         $slugdata=getSubMenusbyslug(Request::segment(2));
                        @endphp

                         
                             @if(getMenusWithPermissions($slugdata->id,'can_add'))

                                <select class="form-control" id="vendorFilter" name="vendor_id">
                                    @if(!empty($vendors))
                                        <option value="">Select Agent</option>
                                       
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" @if(!empty($fetched->vendor_id) && $fetched->vendor_id==$vendor->id){{"selected"}}@endif>{{$vendor->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Agent Available</option>  
                                    @endif

                                    
                                </select>
                                @endif

                               
                            </form>
                           
                     

                        <div class="">
                            
                        @php

                         $role_id = Session::get('role_id');

                         $slugdata=getSubMenusbyslug(Request::segment(2));
                         
                        @endphp

                         
                             @if(getMenusWithPermissions($slugdata->id,'can_add') || getMenusWithPermissions($slugdata->id,'can_edit'))

                             @if($role_id==1)
                             <button type="submit" form="filterForm" class="btn btn-success ms-2">Export {{$title}}</button>
                             @endif
                             <a href="{{ route('admin.leadcreate') }}" class="btn btn-primary">Add {{$title}}</a>
                            <!-- <button type="button" onclick="deletedchecked()"class="btn btn-danger">Delete Selected item</button> -->
                            @endif
                        </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="user_list" class="table table-bordered  nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                  
                                    <th data-ordering="false">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                        </div>
                                        SR No.
                                    </th>
                                    
                                    
                                    <th>Agent Name</th>
                                    <th>Lead Name</th>
                                    <th>Lead Email</th>
                                    <th>Lead Mobile Number</th>
                                    <th>Area Name</th>
                                    <th>City Name</th>
                                    <th>Local Area Name</th>
                                    <th>Created</th>
                                   
                                    @if(getMenusWithPermissions($slugdata->id,'can_view'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        

    </div>
    <!-- container-fluid -->
</div>


<!-- Modal -->
<div class="modal fade" id="leadmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >

       <div class="row g-3">
  <div class="col-md-6"><strong>Agent Name:</strong> <span id="agent_name"></span></div>
  <div class="col-md-6"><strong>Lead Name:</strong> <span id="lead_name"></span></div>
  <div class="col-md-6"><strong>Lead Email:</strong> <span id="lead_email"></span></div>
  <div class="col-md-6"><strong>Lead Mobile:</strong> <span id="lead_mobile"></span></div>

  <div class="col-md-6"><strong>Area Name:</strong> <span id="area_name"></span></div>
  <div class="col-md-6"><strong>City Name:</strong> <span id="city_name"></span></div>
  <div class="col-md-6"><strong>Local Area:</strong> <span id="local_area"></span></div>
  <div class="col-md-6"><strong>Created:</strong> <span id="created_at"></span></div>
</div>


        
      </div>
      
    </div>
  </div>
</div>


@endsection



@section('customscript')
    <script>

        
        $(document).ready(function() {
            
            categorytable();


        });

        function categorytable(vendor_id=""){
            var table =  $("#user_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                url: "{{ route('admin.getleadlistdata') }}", // Server-side URL
                data: function (d) {
                    // Add custom filters to the request data
                    d.vendor_id = vendor_id;
                }
            },  // You can't use Laravel's blade syntax in JS, use route hadmin.elper
                columns: [
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, className: 'action' }, // Checkbox as first column
                    { data: 'vendor_name', name: 'vendor_name' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'area_name', name: 'area_name' },
                    { data: 'city_name', name: 'city_name' },
                    { data: 'local_area_name', name: 'local_area_name' },
                    { data: 'created_at', name: 'created_at' },
                    @if(getMenusWithPermissions($slugdata->id,'can_view'))
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'action' },
                    @endif
                ],
                
            });

            $('#user_list tbody').on('click', 'tr', function (e) {
                    // Check if the clicked element is within the 'action' column
                    if (!$(e.target).closest('td').hasClass('action')) {
                        var url = $(this).data('url');
                        if (url) {
                            window.location.href = url;
                        }
                    }
                });
        }
            
            // Example dynamic JavaScript for the page
            $('#checkAll').on('click', function() {
                $('.form-check-input').prop('checked', this.checked);
            });
            
            $('#vendorFilter').on('change', function() {
                
                // var statusValue = $(this).attr('data-val');  // Get the data-val from the clicked element
                var vendor_id = $(this).val();  
                
                // if(statusValue==1){
                //     location.reload();
                // }else{
                    $('#user_list').DataTable().destroy();
                    categorytable(vendor_id);
                // }

            });

            

            function viewdata(id){

                // $('#leadmodal').modal('show'); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: `{{ route('admin.leadview') }}`,
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (res) {
                        if (res.success) {
                            $('#agent_name').text(res.data.agent_name);
                            $('#lead_name').text(res.data.name);
                            $('#lead_email').text(res.data.email);
                            $('#lead_mobile').text(res.data.phone);
                            $('#area_name').text(res.data.area_name);
                            $('#city_name').text(res.data.city_name);
                            $('#local_area').text(res.data.local_area);
                            $('#created_at').text(res.data.created_at);

                            $('#leadmodal').modal('show'); // Show the modal
                         }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("!Opps ", "Something went wrong, try again later", "error");
                    }
                });




            }

            function deleted(items) {
                    swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure you want to Delete Lead ?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes'
                    }).then(function(result) {
                        if (result.value) {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                }
                            });

                            $.ajax({
                                url: `{{ url('leaddelete') }}/${items}`,
                                type: 'DELETE',
                                
                            //  dataType:'json',
                                beforeSend: function() {
                                    swal.fire({
                                        title: 'Please Wait..!',
                                        text: 'Is working..',
                                        onOpen: function() {
                                            swal.showLoading()
                                        }
                                    })
                                },
                                success: function(data) {
                                    swal.fire({
                                        // position: 'top-right',
                                        type: 'success',
                                        title: 'Lead data Deleted Successfully',
                                        // showConfirmButton: false,
                                        // timer: 5000
                                    
                                    });
                                },
                                complete: function() {
                                    swal.hideLoading();
                                    location.reload();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    swal.hideLoading();
                                    swal.fire("!Opps ", "Something went wrong, try again later", "error");
                                }
                            });
                        }
                    });
            }




            function deletedchecked() {
                    const selectedValues = [];
                    
                   $('input[type="checkbox"].form-check-input:checked').each(function () {
                        selectedValues.push($(this).val());
                    });

                    if (selectedValues.length != 0) {
                        deletedcheckeditem(selectedValues);
                    } else {
                    swal.fire("! Opps ", "Please check Lead data to delete", "error");
                    }
            }
         
         
         
         
         
         
         
         function deletedcheckeditem(items) {
             swal.fire({
                 title: 'Are you sure?',
                 text: "Are you sure you want to Delete Lead?",
                 type: 'warning',
                 showCancelButton: true,
                 confirmButtonText: 'Yes'
             }).then(function(result) {
                 if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                     $.ajax({
                         url: `{{ route('admin.deleteselectedlead') }}`,
                         type: 'POST',
                         data:{
                                items: items
                            },
                         // dataType:'json',
                         beforeSend: function() {
                             swal.fire({
                                 title: 'Please Wait..!',
                                 text: 'Is working..',
                                 onOpen: function() {
                                     swal.showLoading()
                                 }
                             })
                         },
                         success: function(data) {
                             swal.fire({
                                 // position: 'top-right',
                                 type: 'success',
                                 title: 'Lead Deleted Successfully',
                                 // showConfirmButton: false,
                                 // timer: 5000
                                
                             });
                         },
                         complete: function() {
                             swal.hideLoading();
                             location.reload();
                         },
                         error: function(jqXHR, textStatus, errorThrown) {
                             swal.hideLoading();
                             swal.fire("!Opps ", "Something went wrong, try again later", "error");
                         }
                     });
                 }
             });
         }
         
        
          
    </script>
@endsection


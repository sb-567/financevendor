@extends('vendor.master')
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
                        <h5 class="card-title mb-0">{{ $title }} List</h5>

                          <div class="d-flex justify-content-between align-items-center mt-4">
                           
                                               
                        @php
                         $slugdata=getSubMenusbyslug(Request::segment(2));
                        @endphp

                         
                            <div class="d-flex">

                                <div class="me-3">
                                <label for="vendorFilter" class="form-label me-2">Filter by Status:</label>
                                <select class="form-control me-3" id="vendorFilter" name="vendor_id">
                                    
                                    <option value=""  disabled>-- Select verification Status --</option>
                                    <option value="2" selected>All</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                    
                                </select>
                                </div>

                                <div class="me-3">
                                <label for="subscriptionFilter" class="form-label me-2">Filter by Subscription Type:</label>
                                <select class="form-control me-3" id="subscriptionFilter" name="vendor_id">
                                    
                                <option value=""  disabled>-- Select Subscription Type --</option>
                                <option value="0" selected>All</option>
                                <option value="1" >Day wise</option>
                                <option value="2" >Lead wise</option>
                                    
                                </select>
                                </div>

                                <div class="me-3">
                                <label for="subscriptionstateFilter" class="form-label me-2">Filter by Subscription State:</label>
                                <select class="form-control me-3" id="subscriptionstateFilter" name="vendor_id">
                                    
                                <option value=""  disabled>-- Select Subscription State --</option>
                                <option value="0" selected>All</option>
                                <option value="1" >Active</option>
                                <option value="2" >Inactive</option>
                                    
                                </select>
                                </div>
<!--                                 
                                <select class="form-control me-3" id="vendorFilter" name="vendor_id">
                                    
                                <option value="" selected disabled>-- Select City --</option>
                                <option value="1" class="status" data-val="1">All</option>
                                <option value="2" class="status" data-val="2">Active</option>
                                <option value="3" class="status" data-val="3">Inactive</option>
                                    
                                </select>
                                
                                <select class="form-control me-3" id="vendorFilter" name="vendor_id">
                                    
                                <option value="" selected disabled>-- Select Area --</option>
                                <option value="1" class="status" data-val="1">All</option>
                                <option value="2" class="status" data-val="2">Active</option>
                                <option value="3" class="status" data-val="3">Inactive</option>
                                    
                                </select> -->

                                </div>


                        <!-- <div class="text-end"> -->

                         @php

                         $role_id = Session::get('role_id');

                         $slugdata=getSubMenusbyslug(Request::segment(2));
                         
                        @endphp

                         
                             @if(getMenusWithPermissions($slugdata->id,'can_add') || getMenusWithPermissions($slugdata->id,'can_edit'))

                            <a href="{{ route('admin.agentcreate') }}" class="btn btn-primary">Add {{ $title }}</a>
                            <!-- <button type="button" onclick="deletedchecked()"class="btn btn-danger">Delete Selected item</button> -->
                           @endif
                        </div>
                        {{-- </div> --}}

                    </div>
                    <div class="card-body">
                        <table id="user_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                  
                                    <th data-ordering="false">
                                        <!-- <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                        </div> -->
                                        SR No.
                                    </th>
                                    
                             
                                    <th>Subscription </th>
                                    <th>Order No</th>
                                    <th>Amount</th>
                                    <th>Created</th>
                                    <!-- <th>Action</th>  -->
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        

    </div>
    <!-- container-fluid -->
</div>




<div class="modal fade" id="leadmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lead Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >

       <div class="row g-3">
  
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

        
       $(document).ready(function () {

    var table = $('#vendor_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.getvendorlistdata') }}",
            data: function (d) {
                // Always fetch latest filter value
                d.selected_status = $('#vendorFilter').val();
            }
        },
        columns: [
            { data: 'checkbox', orderable: false, searchable: false, className: 'action' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'mobile' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'action', orderable: false, searchable: false, className: 'action' }
        ]
    });

        });

        function categorytable(vendor_id=""){
            var table =  $("#user_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                url: "{{ route('vendors.getorderlistdata') }}", // Server-side URL
                data: function (d) {
                    // Add custom filters to the request data
                    d.vendor_id = vendor_id;
                }
            },  // You can't use Laravel's blade syntax in JS, use route helper
                columns: [
                    {
                        data: null,
                        name: 'srno',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'title', name: 'title' },
                    { data: 'order_no', name: 'order_no' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    // { data: 'action', name: 'action', orderable: false, searchable: false, className: 'action' }
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


            

            function viewdata(id){

                // $('#leadmodal').modal('show'); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: `{{ route('vendors.leadview') }}`,
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
                                url: `{{ route('vendors.leaddelete', '') }}/${items}`,
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
<<<<<<< HEAD:resources/views/admin/vendors/vendorslist.blade.php
                         url: `{{ route('admin.deleteselectedvendor') }}`,
=======
                        url: "{{ route('deleteselectedlead') }}",
>>>>>>> vendors:resources/views/vendor/order/order.blade.php
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


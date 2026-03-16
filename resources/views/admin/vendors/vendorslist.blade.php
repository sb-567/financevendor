@extends('admin.master')
@section('title','Agent List')

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
                            <li class="breadcrumb-item active">{{ $title }} List</li>
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
                         $slugdata=getSubMenusbyslug(Request::segment(1));
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

                         $slugdata=getSubMenusbyslug(Request::segment(1));
                         
                        @endphp

                         
                             @if(getMenusWithPermissions($slugdata->id,'can_add') || getMenusWithPermissions($slugdata->id,'can_edit'))

                            <a href="{{ route('agentcreate') }}" class="btn btn-primary">Add {{ $title }}</a>
                            <!-- <button type="button" onclick="deletedchecked()"class="btn btn-danger">Delete Selected item</button> -->
                           @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="vendor_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                  
                                    <th data-ordering="false">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" >
                                        </div>
                                        SR No.
                                    </th>
                                    <th data-ordering="false">Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
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


@endsection



@section('customscript')
    <script>

        
       $(document).ready(function () {

    var table = $('#vendor_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('getvendorlistdata') }}",
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

    /* Row click navigation (except action column) */
    $('#vendor_list tbody').on('click', 'tr', function (e) {
        if (!$(e.target).closest('td').hasClass('action')) {
            var url = $(this).data('url');
            if (url) {
                window.location.href = url;
            }
        }
    });

    /* Check all checkbox */
    $('#checkAll').on('click', function () {
        $('.form-check-input').prop('checked', this.checked);
    });

    /* Filter change → reload table */
    $('#vendorFilter').on('change', function () {

     let status = $(this).val();
        let url = new URL(window.location.href);

        if (status !== '') {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }

        // Update URL without page reload
        window.history.pushState({}, '', url);

        table.ajax.reload();
    });

});



             $(document).on('change', '.statuschange', function() {
                var status = $(this).prop('checked') ? 1 : 2;
                var id = $(this).data('id');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                $.ajax({
                    url: "{{ route('vendorstatuschange') }}", // Your PHP file to update status
                    type: 'POST',
                    data: { id: id, status: status },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                         
                            if(response.status == 1){
                                
                                swal.fire({
                                            // position: 'top-right',
                                            type: 'success',
                                            title: 'Status Activated successfully!',
                                            // showConfirmButton: false,
                                            timer: 5000
                                        
                                });

                            }else{
                                swal.fire({
                                            // position: 'top-right',
                                            type: 'success',
                                            title: 'Status Inactivated successfully!',
                                            // showConfirmButton: false,
                                            timer: 5000
                                        
                                });
                            }

                        } 
                    },
                    error: function() {
                        swal.fire({
                                        // position: 'top-right',
                                        type: 'success',
                                        title: 'Failed to update status.',
                                        // showConfirmButton: false,
                                        timer: 5000
                                    
                            });
                    }
                });
            });

            function deleted(items) {
                    swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure you want to Delete Vendor List?",
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
                                url: `{{ url('vendordelete') }}/${items}`,
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
                                        title: 'Vendor data Deleted Successfully',
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
                    swal.fire("! Opps ", "Please check vendor to delete", "error");
                    }
            }
         
         
         
         
         
         
         
         function deletedcheckeditem(items) {
             swal.fire({
                 title: 'Are you sure?',
                 text: "Are you sure you want to Delete Vendor?",
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
                         url: `{{ route('deleteselectedvendor') }}`,
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
                                 title: 'Vendor Deleted Successfully',
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


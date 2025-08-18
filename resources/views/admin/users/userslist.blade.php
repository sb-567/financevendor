@extends('admin.master')
@section('title','Users List')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Users List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Users List</li>
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
                        <h5 class="card-title mb-0">Users List</h5>


                        <div class="text-end">
                             <a href="{{ route('usercreate') }}" class="btn btn-primary">Add Users</a>
                            <button type="button" onclick="deletedchecked()"class="btn btn-danger">Delete Selected item</button>
                           
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="user_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                  
                                    <th data-ordering="false">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                        </div>
                                        SR No.
                                    </th>
                                    <th data-ordering="false">Name</th>
                                    
                                    <th>Username</th>
                                    <th>Email</th>
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

        
        $(document).ready(function() {
            
            categorytable();


        });

            function categorytable(status=""){
                var table =  $("#user_list").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                    url: "{{ route('getuserlistdata') }}", // Server-side URL
                    data: function (d) {
                        // Add custom filters to the request data
                        d.selected_status = status;
                    }
                },  // You can't use Laravel's blade syntax in JS, use route helper
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, className: 'action' }, // Checkbox as first column
                        { data: 'name', name: 'name' },
                        
                        { data: 'username', name: 'username' },
                        { data: 'email', name: 'email' },
                        { data: 'status', name: 'status', orderable: false, searchable: false },                        
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'action' }
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
            $('#checkAllvendor').on('click', function() {
                $('.checkbox').prop('checked', this.checked);
            });
            
            $('.status').on('click', function() {
                
                var statusValue = $(this).attr('data-val');  // Get the data-val from the clicked element
                

                if(statusValue==1){
                    location.reload();
                }else{
                    $('#user_list').DataTable().destroy();
                    categorytable(statusValue);
                }

            });

            $(document).on('change', '.statuschange', function() {
                var status = $(this).prop('checked') ? 1 : 0;
                var id = $(this).data('id');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                $.ajax({
                    url: "{{ route('userstatuschange') }}", // Your PHP file to update status
                    type: 'POST',
                    data: { id: id, status: status },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                         

                            swal.fire({
                                        // position: 'top-right',
                                        type: 'success',
                                        title: 'Status updated successfully!',
                                        // showConfirmButton: false,
                                        timer: 5000
                                    
                            });

                        } else {
                            
                            swal.fire({
                                        // position: 'top-right',
                                        type: 'success',
                                        title: 'Failed to update status.',
                                        // showConfirmButton: false,
                                        timer: 5000
                                    
                            });
                        }
                    },
                    error: function() {
                        alert('Error in AJAX request.');
                    }
                });
            });



            function deleted(items) {
                    swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure you want to Delete User List?",
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
                                url: `{{ url('userdelete') }}/${items}`,
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
                                        title: 'User data Deleted Successfully',
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
                    
                    $('input[type="checkbox"].custom-control-input:checked').each(function () {
                        selectedValues.push($(this).val());
                    });

                    if (selectedValues.length != 0) {
                        deletedcheckeditem(selectedValues);
                    } else {
                    swal.fire("! Opps ", "Please check User to delete", "error");
                    }
            }
         
         
         
         
         
         
         
         function deletedcheckeditem(items) {
             swal.fire({
                 title: 'Are you sure?',
                 text: "Are you sure you want to Delete Youtube Url?",
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


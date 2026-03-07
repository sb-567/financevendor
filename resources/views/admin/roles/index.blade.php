@extends('admin.master')
@section('title','Roles')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Role </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Role List</li>
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
                        <h5 class="card-title mb-0">Role List</h5>


                        <div class="text-end">
                            <a href="{{ route('rolecreate') }}" class="btn btn-primary">Add Role</a>
                           
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="vendor_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                               
                                    <th data-ordering="false">Name</th>
                                    
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
                var table =  $("#vendor_list").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                    url: "{{ route('getrolelistdata') }}", // Server-side URL
                    data: function (d) {
                        // Add custom filters to the request data
                        d.selected_status = status;
                    }
                },  // You can't use Laravel's blade syntax in JS, use route helper
                    columns: [
                       
                        { data: 'role_name', name: 'role_name' },              
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'action' }
                    ],
                    
                });

                $('#vendor_list tbody').on('click', 'tr', function (e) {
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
                    $('#vendor_list').DataTable().destroy();
                    categorytable(statusValue);
                }

            });

         
         
        
          
    </script>
@endsection


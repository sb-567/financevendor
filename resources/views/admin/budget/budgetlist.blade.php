@extends('master')
@section('title','Event Task List')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Budget List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Budget List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   


                    <div class="card-body">

                        @include('navigation')

                        <div class="tab-content text-muted">
                            <div class="tab-pane active show" id="pill-justified-home-1" role="tabpanel">
                                
                                <table id="event_list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                        
                                            <th data-ordering="false">
                                                SR No.
                                            </th>
                                            <th data-ordering="false">Vendor Name</th>
                                            <th data-ordering="false">Advance Amount</th>
                                            <th data-ordering="false">Final Amount</th>
                                            <th data-ordering="false">Pending Amount</th>
                                            <th data-ordering="false">Paid Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th colspan="2" >Total:-</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>5000</th>
                                        </tr>
                                </table>


                            </div>
                        </div>
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

        function categorytable(status="") {
            user_id = "{{$user_id}}";
            event_id = "{{$event_id}}";

            var table = $("#event_list").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getbudgetlistdata') }}",
                    data: function (d) {
                        d.selected_status = status;
                        d.user_id = user_id;
                        d.event_id = event_id;
                    }
                },
                columns: [
                    { 
                        data: null, 
                        name: 'sr_no', 
                        orderable: false, 
                        searchable: false, 
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Auto-incrementing row number
                        } 
                    },
                    { data: 'name', name: 'name' },
                    { data: 'advance_amount', name: 'advance_amount' },
                    { data: 'amount', name: 'amount' },
                    { data: 'pending_amount', name: 'pending_amount' },
                    { data: 'pending_amount', name: 'pending_amount' },
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    var sumAdvance = api.column(2, {page: 'current'}).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                    var sumFinal = api.column(3, {page: 'current'}).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                    var sumPending = api.column(4, {page: 'current'}).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                    var sumPaid = api.column(5, {page: 'current'}).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);

                    // Update the footer values
                    $(api.column(2).footer()).html(sumAdvance.toFixed(2));
                    $(api.column(3).footer()).html(sumFinal.toFixed(2));
                    $(api.column(4).footer()).html(sumPending.toFixed(2));
                    $(api.column(5).footer()).html(sumPaid.toFixed(2));
                }
            });

            $('#event_list tbody').on('click', 'tr', function (e) {
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


            $(document).ready(function () {
                $(document).on("change", ".toggle-switch", function () {
                    let switchId = $(this).data("id"); // Get the unique ID of the switch
                    let status = $(this).prop("checked") ? 1 : 0; // Get the checkbox status


                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            }
                        });
                        
                    $.ajax({
                        url: "{{ route('eventstatuschange') }}", // Change to your backend script
                        type: "POST",
                        data: { id: switchId, status: status },
                        success: function (response) {
                            console.log("Server Response:", response);
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                });
            });

            



            function deleted(items) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure you want to Delete Event List?",
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
                            url: `{{ url('eventdelete') }}/${items}`, // Dynamically include 'items' in the URL
                            type: 'DELETE', // Use DELETE HTTP method
                            beforeSend: function() {
                                swal.fire({
                                    title: 'Please Wait..!',
                                    text: 'Is working..',
                                    onOpen: function() {
                                        swal.showLoading();
                                    }
                                });
                            },
                            success: function(data) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Event Deleted Successfully',
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
                    swal.fire("! Opps ", "Please check Event to delete", "error");
                    }
            }
         
         
         
         function deletedcheckeditem(items) {
             swal.fire({
                 title: 'Are you sure?',
                 text: "Are you sure you want to Delete Event?",
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
                         url: `{{ route('deleteselectedevent') }}`,
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
                                 title: 'Event Deleted Successfully',
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


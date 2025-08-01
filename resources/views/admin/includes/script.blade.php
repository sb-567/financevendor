 
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <!-- JAVASCRIPT -->
 <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
 <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
 <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
 <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
 <script src="{{asset('assets/js/plugins.js')}}"></script>

 <script type="text/javascript" src="{{asset("assets/libs/choices.js/public/choices.min.js")}}"></script>
 <script type="text/javascript" src="{{asset("assets/libs/flatpickr/flatpickr.min.js")}}"></script>

 <!-- apexcharts -->
 <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

 <!-- Dashboard init -->
 <script src="{{asset('assets/js/pages/dashboard-crm.init.js')}}"></script>

 <!-- App js -->
 <script src="{{asset('assets/js/app.js')}}"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>


@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    });
</script>
@endif
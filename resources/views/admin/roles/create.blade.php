@extends('admin.master')
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
                            
                            
                                <form method="post" action="{{url('/')}}/rolesave"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="firstnamefloatingInput" name="role_name" placeholder="Enter your Role Name" value="@if(!empty($fetched->role_name)){{$fetched->role_name}}@endif" required>
                                                <label for="firstnamefloatingInput">Role Name</label>
                                            </div>
                                        </div>

                                        
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Menu</th>
                                                        <th>View</th>
                                                        <th>Add</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($menus as $menu)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" id="menu-{{ $menu->id }}" class="check-all-row">
                                                            <label for="menu-{{ $menu->id }}">{{ $menu->menu_name }}</label>
                                                        </td>
                                                        <td><input type="checkbox" name="permissions[{{ $menu->id }}][can_view]" value="1" class="perm"></td>
                                                        <td><input type="checkbox" name="permissions[{{ $menu->id }}][can_add]" value="1" class="perm"></td>
                                                        <td><input type="checkbox" name="permissions[{{ $menu->id }}][can_edit]" value="1" class="perm"></td>
                                                        <td><input type="checkbox" name="permissions[{{ $menu->id }}][can_delete]" value="1" class="perm"></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        
                                        
                                        

                                        
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


@section('customscript')

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.check-all-row').forEach(function(rowCheckbox) {
        rowCheckbox.addEventListener('change', function() {
            let row = this.closest('tr');
            row.querySelectorAll('.perm').forEach(function(permCheckbox) {
                permCheckbox.checked = rowCheckbox.checked;
            });
        });
    });
});
</script>

@endsection
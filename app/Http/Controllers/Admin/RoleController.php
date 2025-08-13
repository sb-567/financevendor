<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Menu;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $menus = Menu::all();
        $title = 'Create Role';
        return view('admin.roles.create', compact('menus','title'));
    }

    public function getrolelistdata(Request $request)
    {
        $query = Role::query();

        // Return DataTable response
        return DataTables::of($query)
            // Filter by search term
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search.value'))) {
                    $keyword = $request->input('search.value');
                    $query->where(function ($q) use ($keyword) {
                        $q->where('role_name', 'like', "%{$keyword}%");
                    });
                }
            })
           
            // Action column
            ->addColumn('action', function ($row) {
            
                        return '<div class="d-flex">
                                    <a href="' . url('guestedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                  
                                  
                                </div>';
            })
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns([ 'action'])
            ->make(true);
    
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'role_name' => $request->role_name
        ]);

        foreach ($request->permissions as $menuId => $perm) {
            RolePermission::create([
                'role_id'   => $role->id,
                'menu_id'   => $menuId,
                'can_view'  => isset($perm['can_view']),
                'can_add'   => isset($perm['can_add']),
                'can_edit'  => isset($perm['can_edit']),
                'can_delete'=> isset($perm['can_delete']),
            ]);
        }

        return redirect()->route('rolelist')->with('success', 'Role created successfully');
    }

}

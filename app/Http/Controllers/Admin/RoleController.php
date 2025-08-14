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
                                    <a href="' . url('roleedit/' . $row->id) . '"  class="btn btn-sm btn-primary me-2"> Edit</a>
                                  
                                  
                                </div>';
            })
            
            // Ensure HTML columns are rendered as raw HTML
            ->rawColumns([ 'action'])
            ->make(true);
    
    }

    public function store(Request $request)
    {
        // Check if we are editing or creating
    if (!empty($request->id)) {
        // UPDATE existing role
            $role = Role::findOrFail($request->id);
            $role->update([
                'role_name' => $request->role_name
            ]);

            // Remove old permissions before re-inserting
            RolePermission::where('role_id', $role->id)->delete();
        } else {
            // CREATE new role
            $role = Role::create([
                'role_name' => $request->role_name
            ]);
        }

        // Save permissions
        if (!empty($request->permissions)) {
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
        }

        return redirect()->route('rolelist')->with('success', 'Role created successfully');
    }

    public function edit(Request $request)
    {   

        

        $role = Role::findOrFail($request->id);
        $menus = Menu::all();
        $permissions = RolePermission::where('role_id', $request->id)->get()->keyBy('menu_id');
        $title = 'Edit Role';
        
        return view('admin.roles.create', compact('role', 'menus', 'permissions', 'title'));
    }
}

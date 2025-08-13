<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;


    protected $table = 'tbl_role_permissions'; // Assuming the table name is tbl_role_permissions

    protected $fillable = ['role_id', 'menu_id', 'can_view', 'can_add', 'can_edit', 'can_delete'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}

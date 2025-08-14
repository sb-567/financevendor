<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolePermission;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tbl_roles'; // Assuming the table name is tbl_roles

     protected $fillable = ['role_name'];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }
    
    

}

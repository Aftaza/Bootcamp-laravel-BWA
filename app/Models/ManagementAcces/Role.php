<?php

namespace App\Models\ManagementAcces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    // use HasFactory;
    use SoftDeletes;

    //declare table name
    public $table = 'role';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function role_user(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAcces\RoleUser', 'role_id');
    }

    public function permission_role(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAcces\PermissionRole', 'role_id');
    }
}

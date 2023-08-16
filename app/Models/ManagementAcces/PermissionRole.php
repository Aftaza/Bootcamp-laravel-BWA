<?php

namespace App\Models\ManagementAcces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model
{
    // use HasFactory;
    use SoftDeletes;

    //declare table name
    public $table = 'permission_role';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'permission_id',
        'role_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function role(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\ManagementAcces\Role', 'role_id', 'id');
    }

    public function permission(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\ManegementAcces\Permission', 'permission_id', 'id');
    }
}
<?php

namespace App\Models\ManagementAcces;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    // use HasFactory;
    use SoftDeletes;

    //declare table name
    public $table = 'permission';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'role_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function role(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\ManagementAcces\Role', 'role_id', 'id');
    }
}

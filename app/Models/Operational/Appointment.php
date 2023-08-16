<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'appoinment';

    //this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'doctor_id',
        'user_id',
        'consultation_id',
        'level',
        'date',
        'time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function doctor(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\Operational\Doctor', 'doctor_id', 'id');
    }

    public function consultation(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\MasterData\Consultation', 'consultation_id', 'id');
    }

    public function user(){
        // 3 parameter required (path model, field foreign key, field primary key from tabel hasMany)
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function transaction(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasOne('App\Models\Operational\Transaction', 'appointment_id');
    }
}

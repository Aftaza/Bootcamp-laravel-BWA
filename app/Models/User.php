<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    // use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role(){
        return $this->belongsToMany('App\Models\ManagementAcces\Role');
    }

    public function appointment(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasMany('App\Models\Operational\Appointment', 'user_id');
    }

    public function detail_user(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasOne('App\Models\ManagementAcces\DetailUser', 'user_id');
    }

    public function role_user(){
        // 2 parameter required (path model, field foreign key)
        return $this->hasMany('App\Models\ManagementAcces\RoleUser', 'user_id');
    }
}

<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'designation',
        'phone_no',
        'address',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $cascadeDeletes = ['userRoleMappings'];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createByUser(): BelongsTo
    {
        return $this->belongsTo(self::class, 'created_by')->withDefault();
    }

    public function updateByUser(): BelongsTo
    {
        return $this->belongsTo(self::class, 'updated_by')->withDefault();
    }

    public function deleteByUser(): BelongsTo
    {
        return $this->belongsTo(self::class, 'deleted_by')->withDefault();
    }

    public function role(): HasOneThrough
    {
        return $this->hasOneThrough(Role::class, UserRoleMapping::class, 'user_id', 'role_id', 'id', 'id');
    }

    public function userRoleMappings()
    {
        return $this->hasMany(UserRoleMapping::class, 'user_id');
    }
}

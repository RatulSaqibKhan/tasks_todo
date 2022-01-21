<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, CascadeSoftDeletes, DataModifiedUsersTrait;

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

    protected $cascadeDeletes = [
        'userRoleMappings',
        'companyUserMappings',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): HasOneThrough
    {
        return $this->hasOneThrough(Role::class, UserRoleMapping::class, 'user_id', 'role_id', 'id', 'id');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_user_mappings', 'user_id', 'company_id');
    }

    public function userRoleMappings(): HasMany
    {
        return $this->hasMany(UserRoleMapping::class, 'user_id');
    }

    public function companyUserMappings(): HasMany
    {
        return $this->hasMany(CompanyUserMapping::class, 'user_id');
    }
}

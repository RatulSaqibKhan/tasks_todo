<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, DataModifiedUsersTrait;

    protected $fillable = [
        'name',
        'email',
        'address',
        'attention',
        'party_type',
        'phone_no',
        'fax',
        'logo',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [
        'companyUserMappings',
        'holidays',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user_mappings', 'company_id', 'user_id');
    }

    public function companyUserMappings(): HasMany
    {
        return $this->hasMany(CompanyUserMapping::class, 'user_id');
    }

    public function holidays(): HasMany
    {
        return $this->hasMany(Holiday::class, 'company_id');
    }
}

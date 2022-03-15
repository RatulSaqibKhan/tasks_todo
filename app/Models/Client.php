<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait, CascadeSoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'address',
        'attention',
        'party_type',
        'phone_no',
        'fax',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [
        'jobs',
        'jobTaskBreakdowns'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'client_id');
    }

    public function jobTaskBreakdowns(): HasMany
    {
        return $this->hasMany(JobTaskBreakDown::class, 'client_id');
    }
}

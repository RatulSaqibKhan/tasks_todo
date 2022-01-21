<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait, CascadeSoftDeletes;

    protected $fillable = [
        'name',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $cascadeDeletes = [
        'templates',
        'jobs',
        'jobTaskBreakdowns'
    ];

    protected $dates = ['deleted_at'];

    public function templates(): HasMany
    {
        return $this->hasMany(Template::class, 'job_type_id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'job_type_id');
    }

    public function jobTaskBreakdowns(): HasMany
    {
        return $this->hasMany(JobTaskBreakDown::class, 'job_type_id');
    }
}

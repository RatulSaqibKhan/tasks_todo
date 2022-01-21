<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait, CascadeSoftDeletes;

    protected $fillable = [
        'name',
        'company_id',
        'job_type_id',
        'task_completion_basis',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $cascadeDeletes = [
        'templateTasksMappings',
        'jobs'
    ];

    protected $dates = ['deleted_at'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id')->withDefault();
    }

    public function templateTasksMappings(): HasMany
    {
        return $this->hasMany(TemplateTasksMapping::class, 'template_id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'template_id');
    }
}

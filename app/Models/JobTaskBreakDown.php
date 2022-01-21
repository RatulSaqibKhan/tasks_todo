<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTaskBreakDown extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait;

    protected $fillable = [
        'company_id',
        'client_id',
        'job_type_id',
        'template_id',
        'job_id',
        'task_id',
        'task_sequence',
        'task_completion_basis',
        'task_completion_time',
        'estimated_start_date',
        'estimated_end_date',
        'actual_start_date',
        'actual_end_date',
        'actual_task_completion_time',
        'assigned_to',
        'attachment',
        'remarks',
        'completion_status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = ['deleted_at'];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id')->withDefault();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault();
    }

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id')->withDefault();
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id')->withDefault();
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id')->withDefault();
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to')->withDefault();
    }
}

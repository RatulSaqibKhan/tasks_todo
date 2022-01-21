<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateTasksMapping extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait;

    public $fillable = [
        'company_id',
        'template_id',
        'task_id',
        'task_completion_basis',
        'task_completion_time',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = ['deleted_at'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id')->withDefault();
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id')->withDefault();
    }
}

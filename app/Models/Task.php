<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait, CascadeSoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $cascadeDeletes = [
        'templateTasksMappings',
        'jobTaskBreakdowns'
    ];

    protected $dates = ['deleted_at'];

    public function templateTasksMappings(): HasMany
    {
        return $this->hasMany(TemplateTasksMapping::class, 'task_id');
    }

    public function jobTaskBreakdowns(): HasMany
    {
        return $this->hasMany(JobTaskBreakDown::class, 'task_id');
    }
}

<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait, CascadeSoftDeletes;

    protected $fillable = [
        'company_id',
        'client_id',
        'job_type_id',
        'template_id',
        'job_no',
        'description',
        'job_value',
        'reference_no',
        'receive_date',
        'delivery_date',
        'lead_time',
        'remarks',
        'attachment',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

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
}

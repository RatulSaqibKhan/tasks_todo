<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait;

    protected $fillable = [
        'name',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

}

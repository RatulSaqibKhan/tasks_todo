<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait;

    protected $fillable = [
        'company_id',
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

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }
}

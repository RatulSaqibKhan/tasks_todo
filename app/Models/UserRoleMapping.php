<?php

namespace App\Models;

use App\Traits\DataModifiedUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoleMapping extends Model
{
    use HasFactory, SoftDeletes, DataModifiedUsersTrait;

    protected $fillable = [
        'user_id',
        'role_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id')->withDefault();
    }

}

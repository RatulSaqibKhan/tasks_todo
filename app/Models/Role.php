<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function user(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserRoleMapping::class, 'role_id', 'user_id', 'id', 'id');
    }
}

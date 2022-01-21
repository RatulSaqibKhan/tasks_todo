<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

trait DataModifiedUsersTrait
{

    protected static function bootModelTrait()
    {
        static::creating(function ($model) {
            if (in_array('created_by', $model->getFillable())) {
                $model->created_by = currentUserId();
            }
        });

        static::saving(function ($model) {
            if (!$model->id) {
                $model->created_at = now();
                if (in_array('created_by', $model->getFillable())) {
                    $model->created_by = currentUserId();
                }
            }
            $model->updated_at = now();
            if (in_array('updated_by', $model->getFillable())) {
                $model->updated_by = currentUserId();
            }
        });

        static::deleting(function ($model) {
            if (in_array('deleted_by', $model->getFillable())) {
                DB::table($model->table)
                    ->where('id', $model->id)
                    ->update([
                        'deleted_by' => currentUserId(),
                    ]);
            }
        });

        static::updating(function ($model) {
            if (in_array('updated_by', $model->getFillable())) {
                $model->updated_by = currentUserId();
            }
        });
    }

    public function createByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function updateByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }

    public function deleteByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by')->withDefault();
    }
}

<?php

namespace App\Services;

use Closure;

class FilterClosureQueryService
{
    public static function where($columnName, $search, $equalCheck = true): Closure
    {
        return function($query) use ($columnName, $search, $equalCheck) {
            return $equalCheck ? $query->where($columnName, $search) : $query->where($columnName, '!=',$search);
        };
    }

    public static function whereLike($columnName, $search): Closure
    {
        return function($query) use ($columnName, $search) {
            return $query->where($columnName, 'like', '%'.$search);
        };
    }
}
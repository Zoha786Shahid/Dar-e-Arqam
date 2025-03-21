<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class SearchHelper
{
    public static function filterByTeacherName(Builder $query, ?string $search): Builder
    {
        if ($search) {
            $query->whereHas('teacher', function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                  ->orWhere('last_name', 'LIKE', "%$search%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
            });
        }

        return $query;
    }
}

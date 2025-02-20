<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class SearchHelper
{
    /**
     * Apply a search filter to a query based on teacher's name.
     *
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    // public static function filterByTeacherName(Builder $query, ?string $search): Builder
    // {
    //     if ($search) {
    //         $query->whereHas('teacher', function ($q) use ($search) {
    //             $q->where('first_name', 'LIKE', "%$search%")
    //               ->orWhere('last_name', 'LIKE', "%$search%");
    //         });
    //     }

    //     return $query;
    // }
    public static function filterByTeacherName($query, $search)
{
    return $query->whereHas('teacher', function ($q) use ($search) {
        $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
    });
}

}

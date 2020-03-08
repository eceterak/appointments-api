<?php

namespace App;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'title', 'phone', 'date_of_birth'
    ];

    /**
     * Scope to get access to QueryBuilder.
     * 
     * @param $query
     * @param QueryFilter $filters
     * @return QueryFilters
     */
    public function scopeFilter($query, QueryFilter $filters) 
    {
        return $filters->apply($query);
    }
}

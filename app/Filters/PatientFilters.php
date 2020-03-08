<?php

namespace App\Filters;

class PatientFilters extends QueryFilter
{
    protected $filters = [
        'name'
    ];

    /**
     * Filter by name
     * 
     * @param int $value
     * @return QueryBuilder
     */
    public function name($value = null)
    {
        return $this->builder->whereRaw('name LIKE ?', $value.'%');
    }
}
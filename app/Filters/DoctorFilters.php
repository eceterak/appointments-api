<?php

namespace App\Filters;

class DoctorFilters extends QueryFilter
{
    protected $filters = [
        'surname'
    ];

    /**
     * Filter by surname
     * 
     * @param int $value
     * @return QueryBuilder
     */
    public function surname($value = null)
    {
        return $this->builder->whereRaw('surname LIKE ?', $value.'%');
    }
}
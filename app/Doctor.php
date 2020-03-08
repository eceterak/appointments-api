<?php

namespace App;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'title', 'department_id'
    ];

    /**
     * Eager loading.
     * 
     * @var array
     */
    // protected $with = [
    //     'images'
    // ];

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

    /**
     * Doctor belongs to a department.
     */
    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'owner');
    }

    /**
     * Get all appointments.
     */
    public function appointments() 
    {
        return $this->hasMany(Appointment::class);
    }
}

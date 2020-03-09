<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * @var Array
     */
    protected $fillable = [
        'name', 'department_id', 'description'
    ];

    /**
     * Service belongs to department
     * @return Departmnet
     */
    public function department() 
    {
        return $this->belongsTo(Department::class);
    }
    
}

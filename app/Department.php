<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return hasMany(Doctor)
     */
    public function doctors() 
    {
        return $this->hasMany(Doctor::class);
    }
}
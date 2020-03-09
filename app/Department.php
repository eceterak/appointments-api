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

    /**
     * @return hasMany(Service)
     */
    public function services() 
    {
        return $this->hasMany(Service::class);
    }
}
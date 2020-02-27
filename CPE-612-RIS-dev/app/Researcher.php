<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{
    public $fillable = [
        'id',
        'project_id',
        'reseacher_id',
        'department_id',
        'work_ratio',
        'OHC',
        'note'
    ];

    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer', 'reseacher_id');
    }

    public function departments() 
    {
        return $this->belongsTo('App\Department', 'department_id');
    }
}
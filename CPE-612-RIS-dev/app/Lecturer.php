<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    public $fillable = [
        'researchdb_id',
        'prename',
        'name',
        'fullname',
        'major',
        'cmuitaccount',
        'penname'
    ];

    public $casts = [
        'penname' => 'array',
    ];

    public function activities() 
    {
        return $this->hasMany('App\Activity');
    }
}

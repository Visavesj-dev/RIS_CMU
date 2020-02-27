<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $fillable = [
        'visitor_id',
        'name',
        'position',
        'speciality'
    ];

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
}

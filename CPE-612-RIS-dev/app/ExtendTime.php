<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtendTime extends Model
{
    public $fillable = [
        'date',
        'reason',
        'note',
        'project_id'
    ];

    protected $dates = [
        'date'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutboundStudentChecklist extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

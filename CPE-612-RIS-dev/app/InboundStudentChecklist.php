<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InboundStudentChecklist extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

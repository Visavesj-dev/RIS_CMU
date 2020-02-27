<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFundType extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

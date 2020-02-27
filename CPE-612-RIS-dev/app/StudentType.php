<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentType extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

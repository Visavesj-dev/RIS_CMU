<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

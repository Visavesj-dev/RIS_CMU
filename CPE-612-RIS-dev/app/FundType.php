<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundType extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name'
    ];
}

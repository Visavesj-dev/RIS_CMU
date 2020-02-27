<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaExpirationDate extends Model
{
    public $fillable = [
        'inbound_student_id',
        'expired_at'
    ];

    public $dates = [
        'expired_at'
    ];
}

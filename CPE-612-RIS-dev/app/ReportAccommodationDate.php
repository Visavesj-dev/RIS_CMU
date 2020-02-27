<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAccommodationDate extends Model
{
    public $fillable = [
        'inbound_student_id',
        'reported_at'
    ];

    public $dates = [
        'reported_at'
    ];
}

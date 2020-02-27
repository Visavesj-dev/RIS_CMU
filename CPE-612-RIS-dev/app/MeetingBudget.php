<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingBudget extends Model
{
    public $fillable = [
        'name',
        'expect_amount',
        'actual_amount',
        'note',
        'meeting_id'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}

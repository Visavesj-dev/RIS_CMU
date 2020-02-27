<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    public $fillable = [
        'title',
        'detail',
        'started_at',
        'ended_at'
    ];

    public $dates = [
        'started_at',
        'ended_at'
    ];

    public function parent()
    {
        return $this->morphTo('activitable');
    }

    public function attachment()
    {
        return $this->morphOne('App\File', 'attachable');
    }

    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer');
    }

    public function programs() 
    {
        return $this->belongsToMany('App\Program');
    }

    public function otherProgram() 
    {
        return $this->belongsTo('App\Program', 'program_id');
    }

    public function scopeUnexpired()
    {
        return $this->whereDate('ended_at', '>=', Carbon::today()->toDateString());
    }

    public function scopeExpired()
    {
        return $this->whereDate('ended_at', '<', Carbon::today()->toDateString());
    }
}

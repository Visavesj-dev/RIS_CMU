<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mou extends Model
{
    public $fillable = [
        'detail',
        'made_agreement_at',
        'started_at',
        'ended_at'
    ];

    protected $dates = [
        'made_agreement_at',
        'started_at',
        'ended_at'
    ];

    public function type()
    {
        return $this->belongsTo('App\MouType', 'mou_type_id');
    }

    public function partners()
    {
        return $this->hasMany('App\Partner');
    }

    public function departments()
    {
        return $this->morphToMany('App\Department', 'associable');
    }

    public function otherDepartment()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }

    public function moas()
    {
        return $this->hasMany('App\Moa');
    }

    public function attachment()
    {
        return $this->morphOne('App\File', 'attachable');
    }

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activitable');
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

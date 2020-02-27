<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mou;
use Illuminate\Support\Carbon;

class Moa extends Model
{
    public $fillable = [
        'title',
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

    public function setMouAttribute(Mou $mou)
    {
        $this->mou()->associate($mou);
    }

    public function mou()
    {
        return $this->belongsTo('App\Mou');
    }

    public function departments() 
    {
        return $this->morphToMany('App\Department', 'associable');
    }

    public function otherDepartment() 
    {
        return $this->belongsTo('App\Department', 'department_id');
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

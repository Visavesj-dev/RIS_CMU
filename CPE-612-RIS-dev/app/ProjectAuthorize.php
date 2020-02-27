<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProjectAuthorize extends Model
{
    public $fillable = [
        'started_at',
        'ended_at',
        'project_id'
    ];

    protected $dates = [
        'started_at',
        'ended_at'
    ];

    public function act()
    {
        return $this->belongsTo('App\Act', 'act_id');
    }

    public function authorizes()
    {
        return $this->hasMany('App\Authorize');
    }

    public function authorize_lists()
    {
        return $this->morphToMany('App\Authorize_list', 'authorize_list_associable');
    }

    public function otherAuthorize_list()
    {
        return $this->belongsTo('App\Authorize_list', 'authorize_list_id');
    }

    // public function attachment()
    // {
    //     return $this->morphOne('App\File', 'attachable');
    // }

    // public function activities()
    // {
    //     return $this->morphMany('App\Activity', 'activitable');
    // }

    public function scopeUnexpired()
    {
        return $this->whereDate('ended_at', '>=', Carbon::today()->toDateString());
    }

    public function scopeExpired()
    {
        return $this->whereDate('ended_at', '<', Carbon::today()->toDateString());
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}

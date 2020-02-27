<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $fillable = [
        'university',
        'note' ,
        'started_at',
        'ended_at' ,
        'visited_at' ,
        'description'
    ];

    protected $dates = [
        'started_at',
        'ended_at',
        'visited_at'
    ];

    public function guests() 
    {
        return $this->hasMany('App\Guest');
    }

    public function hosts() 
    {
        return $this->hasMany('App\Host')->orderBy('position')->orderBy('name');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function attachments()
    {
        return $this->morphMany('App\File', 'attachable');
    }

    public function attachment_group_photo()
    {
        return $this->attachments()->where('name', 'like', 'group_photo_%')->first();
    }

    public function attachment_memento()
    {
        return $this->attachments()->where('name', 'like', 'memento_%')->first();
    }

    public function attachment_meeting_summary()
    {
        return $this->attachments()->where('name', 'like', 'meeting_summary_%')->first();
    }

    public function attachment_other()
    {
        return $this->attachments()->where('name', 'like', 'other_%')->first();
    }
}

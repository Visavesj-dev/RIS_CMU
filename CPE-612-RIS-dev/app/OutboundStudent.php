<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutboundStudent extends Model
{
    public $fillable = [
        'student_type_id',
        'student_id',
        'prefix',
        'first_name',
        'last_name',
        'department_id',
        'advisor_id',
        'telephone',
        'email',
        'passport_id',
        
        'cooperation_name',
        'project',
        'travelled_at',
        'returned_at',
        'university',
        'coordinator_name',
        'coordinator_email',
        'subject',
        'accommodation',
        'note'
    ];

    public $dates = [
        'travelled_at',
        'returned_at'
    ];

    public $with = [
        'type',
        'advisor',
        'department',
        'funds',
        'checklist'
    ];

    public function type()
    {
        return $this->belongsTo('App\StudentType', 'student_type_id');
    }

    public function advisor()
    {
        return $this->belongsTo('App\Lecturer');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function funds()
    {
        return $this->hasMany('App\StudentFund');
    }

    public function checklist()
    {
        return $this->belongsToMany('App\OutboundStudentChecklist', 'outbound_student_checklist')->withPivot([
            'created_at',
            'updated_at'
        ]);;
    }

    public function attachments()
    {
        return $this->morphMany('App\File', 'attachable');
    }

    public function photo()
    {
        return $this->attachments()->where('name', 'like', 'photo_%')->first();
    }

    public function passport()
    {
        return $this->attachments()->where('name', 'like', 'passport_%')->first();
    }

    public function activityReport()
    {
        return $this->attachments()->where('name', 'like', 'activity_report_%')->first();
    }

    public function travellingReport()
    {
        return $this->attachments()->where('name', 'like', 'travelling_report_%')->first();
    }

    public function attachment()
    {
        return $this->attachments()->where('name', 'like', 'other_%')->first();
    }

    public function getFullNameAttribute()
    {
        return "{$this->prefix}.{$this->first_name} {$this->last_name}";
    }

    public function scopeNotTravelled()
    {
        return $this->where('travelled_at', '>', Carbon::today()->toDateString());
    }
    
    public function scopeNotReturned()
    {
        return $this->where('returned_at', '>', Carbon::today()->toDateString());
    }
}

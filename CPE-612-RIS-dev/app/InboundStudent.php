<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InboundStudent extends Model
{
    public $fillable = [
        'student_type_id',
        'prefix',
        'first_name',
        'last_name',
        'university',
        'country_id',
        'email',
        'passport_id',
        'cooperation_name',
        'project',
        'arrived_at',
        'departed_at',
        'department_id',
        'lecturer_id',
        'degree',
        'student_id',
        'telephone',
        'subject',
        'accommodation',
        'note'
    ];

    public $dates = [
        'arrived_at',
        'departed_at'
    ];

    public $with = [
        'type',
        'country',
        'advisor',
        'department',
        'visaExpirationDates',
        'reportAccommodationDates',
        'checklist'
    ];

    public function type()
    {
        return $this->belongsTo('App\StudentType', 'student_type_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function advisor()
    {
        return $this->belongsTo('App\Lecturer', 'lecturer_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function visaExpirationDates()
    {
        return $this->hasMany('App\VisaExpirationDate');
    }

    public function latestVisaExpirationDate()
    {
        return $this->visaExpirationDates()->orderBy('created_at', 'desc')->first();
    }
    
    public function reportAccommodationDates()
    {
        return $this->hasMany('App\ReportAccommodationDate');
    }

    public function latestReportAccommodationDate()
    {
        return $this->reportAccommodationDates()->orderBy('created_at', 'desc')->first();
    }

    public function checklist()
    {
        return $this->belongsToMany('App\InboundStudentChecklist', 'inbound_student_checklist')->withPivot([
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

    public function attachment()
    {
        return $this->attachments()->where('name', 'like', 'other_%')->first();
    }

    public function getFullNameAttribute()
    {
        return "{$this->prefix}.{$this->first_name} {$this->last_name}";
    }

    public function scopeNotArrived()
    {
        return $this->where('arrived_at', '>', Carbon::today()->toDateString());
    }
    
    public function scopeNotDeparted()
    {
        return $this->where('departed_at', '>', Carbon::today()->toDateString());
    }
}

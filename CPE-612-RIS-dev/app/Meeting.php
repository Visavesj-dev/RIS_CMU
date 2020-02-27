<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public $fillable = [
        'title',
        'head_of_project',
        'department_id',
        'budget',
        'meeting_place',
        'authorize_financial',
        'autorize_other',
        'procurement_act',
        'started_at',
        'ended_at',

        'actual_expenses',
        'net_income',
        'university_share',
        'faculty_share',
        'department_share',
        'note',
        'closed_at',
    ];

    public $dates = [
        'started_at',
        'ended_at',
        'closed_at'
    ];

    public $cast = [
        'authorize_financial' => 'boolean'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function budgets()
    {
        return $this->hasMany(MeetingBudget::class);
    }

    public function attachments()
    {
        return $this->morphMany(File::class, 'attachable');
    }

    public function meetingSummary()
    {
        return $this->attachments()->where('name', 'like', 'meeting_summary_%')->first();
    }

    public function meetingFinancialReport()
    {
        return $this->attachments()->where('name', 'like', 'meeting_financial_report_%')->first();
    }

    public function getActualIncomeAttribute()
    {
        return $this->budgets->sum('actual_amount');
    }

    public function getExpectIncomeAttribute()
    {
        return $this->budgets->sum('expect_amount');
    }
}

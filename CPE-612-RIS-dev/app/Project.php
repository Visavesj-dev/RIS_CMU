<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    protected $fillable = [
        'project_type',
        'project_name',
        'strategy_type',
        'cmu_mis_code',
        'fund_type',
        'fund_source',
        'started_at',
        'ended_at',
        'fund_giver_name',
        'fund_giver_address',
        'receipt_list',
        'percent_OHC',
        'all_money_project',
        'all_OHC',
        // 'period_calculation',
        'project_status',
        'head_project',
        'department_subject',
        // 'researcher',
        'OHC_type',
        'cmu',
        'faculty',
        'department',
        'reason',

        // 'present_fund',
        // 'accept_fund',
        // 'time_no',
        // 'end_time',
        'close_project',
        'result_project',
        'result_detail'
    ];

    protected $dates = [
        'started_at',
        'ended_at'
    ];

    public function project_authorize()
    {
        return $this->hasMany('App\ProjectAuthorize');
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

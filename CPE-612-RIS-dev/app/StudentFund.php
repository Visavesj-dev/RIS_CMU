<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFund extends Model
{
    public $fillable = [
        'outbound_student_id',
        'student_fund_type_id',
        'name',
        'amount'
    ];

    public $cast = [
        'amount' => 'double'
    ];

    public function type()
    {
        return $this->belongsTo('App\StudentFundType', 'student_fund_type_id');
    }

    public function outboundStudents()
    {
        return $this->belongsToMany('App\OutboundStudent');
    }
}

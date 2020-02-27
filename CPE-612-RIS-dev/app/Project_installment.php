<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_installment extends Model
{
    protected $fillable = [
        'project_id',
        'no',
        'promised_date',
        'receive_date',
        'fund',
        'researcher',
        'ohc',
        'university',
        'faculty',
        'department',
        'fee',
        'advance',
        'insurance',
        'others',
        'notes'
    ];
    public function parent()
    {
        return $this->morphTo('projecttable');
    }
}

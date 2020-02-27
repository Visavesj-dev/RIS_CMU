<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Authorize extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'project_authorize_id', 'act_id', 'project_id'];

    protected $with = ['project_authorize', 'act'];

    public function project_authorize() 
    {
        return $this->belongsTo('App\ProjectAuthorize');
    }

    public function act() 
    {
        return $this->belongsTo('App\Act');
    }
    
}

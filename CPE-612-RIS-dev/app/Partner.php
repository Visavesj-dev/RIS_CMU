<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'mou_id', 'country_id'];

    protected $with = ['mou', 'country'];

    public function mou() 
    {
        return $this->belongsTo('App\Mou');
    }

    public function country() 
    {
        return $this->belongsTo('App\Country');
    }
}

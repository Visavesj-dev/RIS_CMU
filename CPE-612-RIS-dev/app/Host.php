<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    public $fillable = [
        'visitor_id',
        'name',
        'position'
    ];

    public function visitor ()
    {
        return $this->belongsTo('App\Visitor');
    }
}

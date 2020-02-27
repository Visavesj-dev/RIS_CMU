<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'primitive'];

    public function mous() 
    {
        return $this->morphedByMany('App\Mou', 'associable');
    }

    public function scopePrimitive($query)
    {
        return $query->where('primitive', true);
    }

    public function scopeNonPrimitive($query)
    {
        return $query->where('primitive', false);
    }
}

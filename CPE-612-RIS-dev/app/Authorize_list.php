<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorize_list extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'primitive'];

    public function projectAuthorizes() 
    {
        return $this->morphedByMany('App\ProjectAuthorize', 'associable');
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'primitive'
    ];

    protected $casts = [
        'primitive' => 'boolean'
    ];

    public function activities()
    {
        return $this->belongsToMany('App\Activity');
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $fillable = [
        'name',
        'description',
        'research',
        'service',
        'foreign'
    ];

    public $casts = [
        'research' => 'boolean',
        'service' => 'boolean',
        'foreign' => 'boolean'
    ];

    public function attachment()
    {
        return $this->morphOne('App\File', 'attachable');
    }
}

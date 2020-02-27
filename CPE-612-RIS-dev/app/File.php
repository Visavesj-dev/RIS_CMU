<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    public $fillable = ['path', 'name'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function delete()
    {
        Storage::delete($this->path);

        return parent::delete();
    }
}

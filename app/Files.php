<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'name',
        'size',
        'file',
        'path',
        'mime_type',
    ];

    public function relation() {
        return $this->morphTo();
    }
}

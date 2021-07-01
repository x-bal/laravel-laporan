<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $guarded = [];

    public function workMap()
    {
        return $this->belongsTo('App\WorkMap');
    }
}

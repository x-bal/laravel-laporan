<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkMap extends Model
{
    protected $guarded = [];

    public function map()
    {
        return $this->belongsTo('App\Map');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

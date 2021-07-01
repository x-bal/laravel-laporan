<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $guarded = [];

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }
}

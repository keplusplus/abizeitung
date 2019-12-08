<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characteristics extends Model
{
    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function teacher() {
        return $this->hasOne(Teacher::class);
    }
}

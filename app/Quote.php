<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}

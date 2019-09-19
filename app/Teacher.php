<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function votes() {
      return $this->hasMany(Vote::class);
    }

    public function quotes() {
        return $this->hasMany(Quote::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    public function votes() {
      return $this->hasMany(Vote::class);
    }
}

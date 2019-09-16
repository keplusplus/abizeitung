<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    public function votes() {
      $this->hasMany(Vote::class);
    }
}

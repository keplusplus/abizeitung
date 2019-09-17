<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function ranking() {
      return $this->belongsTo(Ranking::class);
    }

    public function teacher() {
      return $this->belongsTo(Teacher::class);
    }

    public function member() {
      return $this->belongsTo(Member::class);
    }
}

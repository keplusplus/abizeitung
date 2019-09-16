<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function ranking() {
      $this->belongsTo(Ranking::class);
    }

    public function teacher() {
      $this->belongsTo(Teacher::class);
    }

    public function member() {
      $this->belongsTo(Member::class);
    }
}

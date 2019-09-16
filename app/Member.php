<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function comments() {
      return $this->hasMany(Comment::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function votes() {
      $this->hasMany(Vote::class);
    }
}

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
      return $this->hasMany(Vote::class);
    }

    public function characteristics() {
        return $this->hasOne(Characteristics::class);
    }

    public function quotes() {
        return $this->hasMany(Quote::class);
    }
}

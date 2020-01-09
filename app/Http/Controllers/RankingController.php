<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Teacher;
use App\Ranking;
use App\Vote;

class RankingController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      $m = Member::all();
      $mm = $m->where('is_woman', 0);
      $mf = $m->where('is_woman', 1);

      $t = Teacher::all()->sortBy('lastname');
      $tm = $t->where('is_woman', 0);
      $tf = $t->where('is_woman', 1);
      $tutors = collect([$t->where('lastname', 'Schmallenbach')->first(), $t->where('lastname', 'Speer')->first()]);

      $rt = Ranking::where('for_teachers', true)->get();
      $rm = Ranking::where('for_teachers', false)->get();

      $args = [
          'members' => $m,
          'members_male' => $mm,
          'members_female' => $mf,
          'teachers' => $t,
          'teachers_male' => $tm,
          'teachers_female' => $tf,
          'tutors' => $tutors,
          'rankings_members' => $rm,
          'rankings_teachers' => $rt];
      return view('ranking/index', $args);
    }

    public function store() {

      if(auth()->user()->has_voted == true) return redirect()->route('home');

      $rankings = Ranking::all();
      $requirements = [];
      foreach ($rankings as $r) {
        $requirements['r' . $r->id] = 'required';
        if($r->pair and !$r->only_tutor) $requirements['r' . $r->id . '_2'] = 'required|different:r' . $r->id;
        if(!$r->pair and !$r->both_genders and !$r->only_tutor) $requirements['r' . $r->id . '_2'] = 'required';
      }

      $data = request()->validate($requirements);

      auth()->user()->has_voted = true;
      auth()->user()->save();

      foreach ($data as $key => $pid) {
        if(!strpos($key, '_2')) {
          $rid = substr($key, 1);

          $vote = new Vote;
          $vote->ranking_id = $rid;
          if(!Ranking::find($rid)->for_teachers) $vote->member_id = $pid;
          else $vote->teacher_id = $pid;

          if((Ranking::find($rid)->pair or !Ranking::find($rid)->both_genders) and !Ranking::find($rid)->only_tutor) {
            if(!Ranking::find($rid)->for_teachers) $vote->member2_id = $data[$key . '_2'];//$vote->member2_id = $pid;
            else $vote->teacher2_id = $data[$key . '_2'];
          }

          $vote->save();
        }
      }

      return redirect()->route('home');
    }
}

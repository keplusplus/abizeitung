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
      $t = Teacher::all()->sortBy('lastname');

      $rt = Ranking::where('for_teachers', true)->get();
      $rm = Ranking::where('for_teachers', false)->get();

      $args = ['members' => $m, 'teachers' => $t, 'rankings_members' => $rm, 'rankings_teachers' => $rt];
      return view('ranking/index', $args);
    }

    public function store() {

      if(auth()->user()->has_voted == true) return redirect()->route('home');

      $rankings = Ranking::all();
      $requirements = [];
      foreach ($rankings as $r) {
        $requirements['r' . $r->id] = 'required';
        if($r->pair) $requirements['r' . $r->id . '_2'] = 'required';
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

          if(Ranking::find($rid)->pair) {
            if(!Ranking::find($rid)->for_teachers) $vote->member2_id = $pid;
            else $vote->teacher2_id = $data[$key . '_2'];
          }

          $vote->save();
        }
      }
      return redirect()->route('home');
    }
}

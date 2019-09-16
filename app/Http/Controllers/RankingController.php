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
      $t = Teacher::all();

      $rt = Ranking::where('for_teachers', true)->get();
      $rm = Ranking::where('for_teachers', false)->get();

      $args = ['members' => $m, 'teachers' => $t, 'rankings_members' => $rm, 'rankings_teachers' => $rt];
      return view('ranking/index', $args);
    }

    public function store() {
      if(auth()->user->has_voted == true) return redirect()->route('home');

      auth()->user()->has_voted = true;
      auth()->user()->save();

      $rankings = Ranking::all();
      $requirements = [];
      foreach ($rankings as $r) {
        $requirements['r' . $r->id] = 'required';
      }

      $data = request()->validate($requirements);

      foreach ($data as $key => $pid) {
        $rid = substr($key, 1);

        $vote = new Vote;
        $vote->ranking_id = $rid;
        if(!Ranking::find($rid)->for_teachers) $vote->member_id = $pid;
        else $vote->teacher_id = $pid;
        $vote->save();
      }

      return redirect()->route('home');
    }
}

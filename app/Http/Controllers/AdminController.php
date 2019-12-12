<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use App\Ranking;

class AdminController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('admin');
    }

    static function random($n) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
      }

      return $randomString;
    }

    public function index() {
      $m = Member::all();
      $m1 = Member::all()->take(1);
      $uidm1 = $m1[0]->user_id;

      $rankings = Ranking::all();

      if(isset($uidm1)) {
        $voted = 0;
        $filled = 0;
        foreach ($m as $member) {
          if($member->user->has_filled) $filled++;
          if($member->user->has_voted) $voted++;
        }
        return view('admin/index', ['members' => $m, 'rankings' => $rankings, 'count_has_voted' => $voted, 'count_has_filled' => $filled]);
      } else {
        return view('admin/index', ['generate' => 1, 'members' => $m]);
      }
    }

    public function edit_ranking($ranking_id) {
      $m = Member::all();
      $m1 = Member::all()->take(1);
      $uidm1 = $m1[0]->user_id;

      $rankings = Ranking::all();

      if(isset($uidm1)) {
        $voted = 0;
        $filled = 0;
        foreach ($m as $member) {
          if($member->user->has_filled) $filled++;
          if($member->user->has_voted) $voted++;
        }
        return view('admin/index', ['members' => $m, 'rankings' => $rankings, 'count_has_voted' => $voted, 'count_has_filled' => $filled, 'edit_ranking' => $ranking_id]);
      } else {
        return view('admin/index', ['generate' => 1, 'members' => $m]);
      }
    }

    public function generate() {
      $members = Member::all();

      foreach ($members as $m) {
        $auth_key = $this->random(12);

        $data = [
          'name' => $auth_key,
          'password' => '0',
          'email' => strtolower($auth_key) . '@abizeitung.keilebrecht.bplaced.net',
        ];

        $user = new User($data);
        $user->save();
        $m->user_id = $user->id;
        $m->save();
      }

      return redirect()->route('admin');
    }
}

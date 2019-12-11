<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Member;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function create() {
      return view('comment/create', ['members' => self::getMembersWithoutAuthenticated()]);
    }

    public function store() {
      $data = request()->validate([
        'member_id' => 'required',
        'comment' => 'required|max:80'
      ]);

      Comment::create($data);

      $members = Member::all();
      unset($members[array_search(Auth::user(), $members)]);
      return view('comment/create', ['members' => self::getMembersWithoutAuthenticated(), 'success' => 1]);

      //dd(request()->all());
    }

    private function getMembersWithoutAuthenticated() {
          $members = Member::all();
          $members->forget($members->search(auth()->user()->member));
          return $members;
    }
}

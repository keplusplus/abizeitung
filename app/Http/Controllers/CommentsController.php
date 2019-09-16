<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function create() {
      $members = Member::all();
      return view('comment/create', ['members' => $members]);
    }

    public function store() {
      $data = request()->validate([
        'member_id' => 'required',
        'comment' => 'required|max:80'
      ]);

      Comment::create($data);

      $members = Member::all();
      return view('comment/create', ['members' => $members, 'success' => 1]);

      //dd(request()->all());
    }
}

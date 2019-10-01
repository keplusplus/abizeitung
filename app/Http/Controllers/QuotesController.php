<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Teacher;
use App\Quote;

class QuotesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        $m = Member::all();
        $t = Teacher::all();
        return view('quote/create', ['members' => $m, 'teachers' => $t]);
    }

    public function store() {
        $data = request()->validate([
          'quote_for_teacher' => 'required',
          'member_id' => '',
          'teacher_id' => '',
          'quote' => 'required'
        ]);

        Quote::create($data);

        $members = Member::all();
        return view('comment/create', ['members' => $members, 'success' => 1]);
    }
}

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
        $t = Teacher::all()->sortBy('lastname');
        return view('quote/create', ['members' => $m, 'teachers' => $t]);
    }

    public function store() {
        $data = request()->validate([
          'quote_for_teacher' => 'required',
          'member_id' => '',
          'teacher_id' => '',
          'quote' => 'required'
        ]);


        if($data["quote_for_teacher"] == 0) {
          unset($data["quote_for_teacher"]);
          $data["for_teachers"] = false;
          Quote::create($data);
        } else if($data["quote_for_teacher"] == 1) {
          unset($data["quote_for_teacher"]);
          $data["for_teachers"] = true;
          Quote::create($data);
        }

        $m = Member::all();
        $t = Teacher::all()->sortBy('lastname');
        return view('quote/create', ['success' => 1, 'members' => $m, 'teachers' => $t]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Teacher;

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

    }
}

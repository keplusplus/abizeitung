<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moment;

class MomentsController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function create() {
      return view('moment/create');
    }

    public function store() {
      $data = request()->validate([
        'text' => 'required|max:250'
      ]);

      Moment::create($data);

      return view('moment/create', ['success' => 1]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function create() {
        return view('characteristics/create');
    }

    public function store()  {
        dd(request());
    }
}

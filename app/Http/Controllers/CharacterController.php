<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Characteristics;

class CharacterController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('characteristics/create');
    }

    public function store()  {
        if(auth()->user()->has_filled) return redirect()->route('home');

        auth()->user()->has_filled = true;
        auth()->user()->save();

        $data = request()->validate([
            'birthdate' => 'required',
            'data_accepted' => 'accepted'
        ]);

        $cs = new Characteristics;
        $cs->member_id = auth()->user()->member->id;
        $cs->birthdate = $data['birthdate'];
        $cs->save();

        return redirect()->route('home');
    }
}

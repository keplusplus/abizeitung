<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Characteristics;
use App\Teacher;

class CharacterController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        $t = Teacher::all();
        return view('characteristics/create', ['teachers' => $t]);
    }

    public function store()  {
        if(auth()->user()->has_filled) return redirect()->route('home');

        auth()->user()->has_filled = true;
        auth()->user()->save();

        $data = request()->validate([
            'birthdate' => 'required',
            'residence' => 'required|max:60',
            'adv_courses' => 'required|max:50',
            'right_advs' => 'required|max:160',
            'best_topics' => 'required|max:120',
            'worst_topics' => 'required|max:120',
            'best_friends' => 'max:120',
            'best_moment' => 'max:120',
            'worst_moment' => 'max:120',
            'teacher_id' => '',
            'way_of_learning' => 'required|max:160',
            'thanks' => 'required|max:800',
            'most_important' => 'required|max:160',
            'after_a_levels' => 'required|max:160',
            'taken_from_school' => 'required|max:160',
            'data_accepted' => 'accepted'
        ]);

        $data["member_id"] = auth()->user()->member->id;
        unset($data["data_accepted"]);
        Characteristics::create($data);

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('idea/create');
    }

    public function store() {
        $data = request()->validate([
          'member_id' => 'required',
          'message' => 'required'
        ]);

        Idea::create($data);

        return view('idea/create', ['success' => 1]);
    }
}

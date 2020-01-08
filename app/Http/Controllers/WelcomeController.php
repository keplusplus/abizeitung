<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class WelcomeController extends Controller
{
    public function index() {
      if(auth()->guest()) return view('welcome', ['error' => 1]);
      else return view('welcome', ['has_voted' => auth()->user()->has_voted, 'has_filled' => auth()->user()->has_filled]);
    }

    public function codelogin($auth_key) {
      if(auth()->guest()) {
        if(strlen($auth_key) != 12) {
          return view('welcome', ['error' => 2]);
        } else {
          //Manual login
          $users = User::where('name', $auth_key)->limit(1)->get();
          if(sizeof($users) < 1) {
            $user = null;
          } else {
            $user = $users[0];
          }

          if(!$user || $user->is_admin == 1) {
            return view('welcome', ['error' => 3]);
          } else {
            Auth::login($user);
            return redirect()->route('home');
          }
        }
      } else {
        // User is authenticated
        return redirect()->route('home');
      }
    }
}

<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];

    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function login(Request $request)
  {
    if (Auth::attempt($request->only('username', 'password'))) {
      return redirect()
        ->route('home');
    }

    return redirect()
      ->route('login')->with('login-error', 'Username or password wrong!');
  }

  public function logout()
  {
    Auth::logout();

    return redirect()
      ->route('login');
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        if (Gate::allows('is-logged-in')) {
            return back();
        }
        return view('PageFunctions.login');
    }

    public function login(Request $request)
    {
        if (Gate::allows('is-logged-in')) {
            return back();
        }

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('mainPage'));
        }

        return back()->withErrors([
            'login' => 'Podane dane są nieprawidłowe!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function adminPage()
    {
        if (Gate::denies('access-admin')) {
            abort(403);
        }
        return view('AdminPages.admin');
    }

}

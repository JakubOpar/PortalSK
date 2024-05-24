<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('PageFunctions.login');
    }

    public function login(Request $request)
    {
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

    public function testAdminAccess()
    {
        // Pobierz aktualnie zalogowanego użytkownika
        $user = Auth::user();
        dd($user);
        // Sprawdź, czy użytkownik ma dostęp do panelu administracyjnego za pomocą bramy
        if (Gate::allows('access-admin', $user)) {
            return "Użytkownik ma dostęp do panelu administracyjnego!";
        } else {
            return "Użytkownik nie ma dostępu do panelu administracyjnego!";
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $offerCount = Offer::count();
        $userCount = User::count();
        $offersPerDay = Offer::selectRaw('COUNT(*) as total_offers, DATE(publication_date) as date')
            ->groupBy('date')
            ->get()
            ->avg('total_offers');
        $offersPerDay = round($offersPerDay);
        $offersPerDayChart = Offer::selectRaw('DATE(publication_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        return view('AdminPages.admin', [
            'offerCount' => $offerCount,
            'userCount' => $userCount,
            'offersPerDay' => $offersPerDay,
            'offersPerDayChart' => $offersPerDayChart
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// use ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

    

        $user = Auth::user();

        if ($user->status == 0) {
            Auth::logout(); // Log out the user
            return redirect()->route('login')->with('status', 'Your account does not have permission to access.');

        }

        if (Auth::user()->role=='1' || Auth::user()->role=='2' || Auth::user()->role=='4' || Auth::user()->role=='5' || Auth::user()->role=='6'){
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role=='3'){
            return redirect()->route('listScheme');
        }

        return redirect()->route('/');
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

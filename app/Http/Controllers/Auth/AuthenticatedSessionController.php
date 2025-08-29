<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View | RedirectResponse
    {
        if(Auth::guard('adm')->check())
            return redirect() -> route('admin.dashboard');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

         if(auth('web')->attempt($request->only(['email','password'])))
            return redirect()-> route ( 'dashboard');

         else if(auth('adm')->attempt($request->only( ['email','password'])))
            return redirect()-> route ( 'admin.dashboard');

         return back()->withErros("Credenciais não cadastradas no sitema.");
         // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if(Auth::guard('web')->check())
            Auth::guard('web')->logout();

        if(Auth::guard('adm')->check())
            Auth::guard('adm')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ─── Show Login Form ──────────────────────────────────────────────────────
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('auth.login');
    }

    // ─── Handle Login ─────────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'L\'adresse e-mail est obligatoire.',
            'email.email'       => 'Veuillez entrer une adresse e-mail valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        // Rate limiting: max 5 attempts per minute per IP+email
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts('login:' . $throttleKey, 5)) {
            $seconds = RateLimiter::availableIn('login:' . $throttleKey);
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => "Trop de tentatives. Réessayez dans {$seconds} secondes."]);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::clear('login:' . $throttleKey);
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Bienvenue ! Vous êtes connecté.');
        }

        RateLimiter::hit('login:' . $throttleKey, 60);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    // ─── Show Register Form ───────────────────────────────────────────────────
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    // ─── Handle Register ──────────────────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:2', 'max:100'],
            'email'    => ['required', 'email', 'max:191', 'unique:users,email'],
            'phone'    => ['required', 'string', 'min:8', 'max:20'],
            'quartier' => ['required', 'string', 'min:2', 'max:150'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'name.required'           => 'Le nom complet est obligatoire.',
            'name.min'                => 'Le nom doit comporter au moins 2 caractères.',
            'email.required'          => 'L\'adresse e-mail est obligatoire.',
            'email.email'             => 'Veuillez entrer une adresse e-mail valide.',
            'email.unique'            => 'Cette adresse e-mail est déjà utilisée.',
            'phone.required'          => 'Le numéro de téléphone est obligatoire.',
            'phone.min'               => 'Le numéro doit comporter au moins 8 chiffres.',
            'quartier.required'       => 'Le quartier est obligatoire.',
            'password.required'       => 'Le mot de passe est obligatoire.',
            'password.confirmed'      => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'            => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'quartier' => $request->quartier,
            'password' => Hash::make($request->password),
            'role'     => 'client',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Compte créé avec succès ! Bienvenue, ' . $user->name . ' 🎉');
    }

    // ─── Logout ───────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}

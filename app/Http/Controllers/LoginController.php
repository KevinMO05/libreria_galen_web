<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function prueba()
    {

        return view('prueba');
    }

    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validated->fails()) {
            return redirect()->route('login')->with('error', 'El correo electrónico debe contener un @');
        }

        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $usuario = Auth::user();

            // Verificar si el correo está verificado
            if (!$usuario->hasverifiedEmail()){
                
                return redirect()->route('verification.notice');
            }

            // Verificar si 2FA está habilitado
            if ($usuario->two_factor_secret) {
                // Desautenticar al usuario y redirigir al desafío 2FA
                Auth::logout();

                // Guardar email en la sesión para el desafío
                session(['login.id' => $usuario->id]);

                return redirect()->route('two-factor.login');
            }

            // Redirigir según el rol
            $redirectTo = route('dashboard');
            return redirect($redirectTo)->with('success', '¡Bienvenido!');
        } else {
            return redirect()->route('login')->with('error', 'Credenciales Incorrectas');
        }
    }

    // ==========AUTENTICACION DE 2 FACTORES 2FA ================
    public function twoFactorChallenge()
    {
        return view('auth.two-factor-challenge');
    }

    public function twoFactorLogin(Request $request)
    {
        $usuario = User::find(session('login.id'));

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Sesión expirada. Intenta iniciar sesión nuevamente.');
        }

        $validated = $request->validate([
            'code' => 'required|numeric',
        ]);

        // Verificar el código TOTP
        if ($usuario->validateTwoFactorCode($validated['code'])) {
            Auth::login($usuario);

            // Limpiar la sesión temporal
            session()->forget('login.id');

            $redirectTo = $usuario->role_id === 1 ? route('admin') : route('dashboard');
            return redirect($redirectTo)->with('success', '¡Bienvenido de nuevo!');
        } else {
            return redirect()->route('two-factor.login')->with('error', 'Código de autenticación inválido.');
        }
    }
}

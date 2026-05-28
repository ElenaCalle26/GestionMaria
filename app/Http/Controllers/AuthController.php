<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id, 'user_name' => $user->name, 'user_role' => $user->role]);
            
            if ($user->role === 'admin') {
                return redirect('/users');
            }
            return redirect('/profile');
        }

        return back()->with('error', 'Credenciales inválidas');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'Sesión cerrada');
    }
}

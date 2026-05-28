<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Listar usuarios (solo admin)
    public function index()
    {
        $users = \App\Models\User::all();
        return view('users.index', compact('users'));
    }

    // Formulario crear usuario
    public function create()
    {
        return view('users.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/users')->with('success', 'Usuario creado correctamente');
    }

    // Formulario editar usuario
    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);
        }

        return redirect('/users')->with('success', 'Usuario actualizado');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        \App\Models\User::findOrFail($id)->delete();
        return redirect('/users')->with('success', 'Usuario eliminado');
    }

    // Perfil del usuario
    public function profile()
    {
        $user = \App\Models\User::findOrFail(session('user_id'));
        return view('profile', compact('user'));
    }
}

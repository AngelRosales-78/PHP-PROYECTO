<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validamos que el usuario envíe los campos requeridos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Buscamos al cliente en la base de datos por su email
        $cliente = DB::table('clientes')->where('email', $request->email)->first();

        // 3. Verificamos si el cliente existe Y si la contraseña es correcta
        if ($cliente && Hash::check($request->password, $cliente->password)) {
            
            // ¡Éxito! Guardamos al usuario en la sesión de Laravel
            Session::put('cliente_id', $cliente->id);
            Session::put('cliente_nombre', $cliente->nombre);

            // Redirige a la página principal o panel de usuario (cambia '/' por tu ruta deseada)
            return redirect('/')->with('success', '¡Bienvenido de vuelta, ' . $cliente->nombre . '!');
        }

        // 4. Si falla, regresamos al login con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }
}
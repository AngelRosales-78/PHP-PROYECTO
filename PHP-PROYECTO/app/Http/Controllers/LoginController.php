<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Modelo para buscar administradores

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar que vengan los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. INTENTO 1: BUSCAR EN LA TABLA 'users' (Para ver si es el Administrador)
        $admin = User::where('email', $request->email)->first();

        // Si existe en 'users' y la contraseña es correcta
        if ($admin && Hash::check($request->password, $admin->password)) {
            if ($admin->rol === 'admin' || $admin->es_admin == 1) {
                // Guardamos sus datos en la sesión
                Session::put('admin_id', $admin->id);
                Session::put('admin_nombre', $admin->name);

                // Redirección al inventario administrativo
                return redirect()->route('admin.inventario')->with('success', 'Bienvenido al Panel de Control.');
            }
        }

        // 3. INTENTO 2: BUSCAR EN LA TABLA 'clientes' (Si no fue admin, revisamos si es cliente común)
        $cliente = DB::table('clientes')->where('email', $request->email)->first();

        // Si existe en 'clientes' y la contraseña es correcta
        if ($cliente && Hash::check($request->password, $cliente->password)) {
            // Guardamos los datos del cliente en la sesión (como lo manejas en tu logout)
            Session::put('cliente_id', $cliente->id);
            Session::put('cliente_nombre', $cliente->nombre);

            // Redirección a la tienda/página principal para clientes comunes
            return redirect('/')->with('success', 'Sesión iniciada correctamente.');
        }

        // Si no coincide en ninguna de las dos tablas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }
}
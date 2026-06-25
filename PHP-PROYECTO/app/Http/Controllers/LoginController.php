<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Usamos tu modelo User para buscar en la tabla 'users'

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar que vengan los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. BUSCAR EN LA TABLA 'users' (Para ver si es el Administrador)
        $admin = User::where('email', $request->email)->first();

        // Si existe en 'users' y la contraseña es correcta
        if ($admin && Hash::check($request->password, $admin->password)) {
            
            // Verificamos si tiene el rol de admin o campo indicador (ej: es_admin == 1 o rol == 'admin')
            // Nota: Si aún no agregas la columna de rol, puedes quitar esta condición temporalmente 
            // suponiendo que CUALQUIER usuario en la tabla 'users' es un administrador.
            if ($admin->rol === 'admin' || $admin->es_admin == 1) {
                
                // Guardamos sus datos en la sesión
                Session::put('admin_id', $admin->id);
                Session::put('admin_nombre', $admin->name);

                // ¡REDIRECCIÓN AUTOMÁTICA AL INVENTARIO!
                return redirect()->route('admin.inventario')->with('success', 'Bienvenido al Panel de Control.');
            }
        }

     

        // Si no coincide en ninguna tabla o las contraseñas están mal
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }
}
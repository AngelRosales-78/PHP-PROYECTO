<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos que todo cumpla con las reglas directamente en el servidor
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_documento' => 'required|string|in:DNI,CE', // Asegura que solo envíen opciones válidas
            'documento' => 'required|string|min:8|max:15',  // Cambiado de size:8 a un rango (DNI=8, CE puede ser más largo)
            'telefono' => 'required|string|min:6|max:15',
            'fecha_nacimiento' => 'required|string',         // Se mantiene string por el formato DD/MM/AAAA enviado por JS
            'email' => 'required|email|ends_with:.com|unique:clientes,email', 
            'password' => 'required|string|min:6|confirmed', 
        ]);

        try {
            // 2. Insertamos los datos de forma segura en la base de datos
            DB::table('clientes')->insert([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encripta la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Redirecciona al login con un mensaje de éxito
            return redirect()->route('login')->with('success', '¡Cuenta creada con éxito!');

        } catch (\Exception $e) {
            // En caso de un error inesperado de la base de datos, regresa informando el problema
            return back()->withInput()->withErrors(['error' => 'Hubo un problema al guardar en la base de datos: ' . $e->getMessage()]);
        }
    }
}
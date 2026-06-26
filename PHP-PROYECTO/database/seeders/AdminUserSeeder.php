<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador ClickUp',
            'email' => 'admin@clickup.com',
            'rol' => 'admin', // Aquí le asignamos el poder
            'password' => Hash::make('admin1234') // Contraseña encriptada
        ]);
    }
}
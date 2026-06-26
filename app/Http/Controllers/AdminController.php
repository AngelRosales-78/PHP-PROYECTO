<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; 
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboardInventario()
    {
        $totalProductos = Producto::count();
        $stockNormal = Producto::where('stock', '>', 10)->count();
        $stockBajo = Producto::whereBetween('stock', [1, 10])->count();
        $sinStock = Producto::where('stock', '<=', 0)->count();
        $totalCategorias = Producto::distinct('categoria')->count('categoria');
        $porcentajeCatalogo = $totalProductos > 0 ? round(($stockNormal / $totalProductos) * 100) : 0;

        return view('admin.inventario', compact(
            'totalProductos', 
            'stockNormal', 
            'stockBajo', 
            'sinStock', 
            'totalCategorias',
            'porcentajeCatalogo'
        ));
    }

    public function crearProducto()
    {
        return view('admin.crear-producto');
    }

    public function guardarProducto(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'precio'    => 'required|numeric|min:0',
            'stock'     => 'required|integer|min:0',
            'imagen'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create([
            'nombre'    => $request->nombre,
            'categoria' => $request->categoria,
            'precio'    => $request->precio,
            'stock'     => $request->stock,
            'imagen'    => $rutaImagen, 
        ]);

        return redirect()->route('admin.inventario')->with('success', '¡Producto creado correctamente!');
    }
}
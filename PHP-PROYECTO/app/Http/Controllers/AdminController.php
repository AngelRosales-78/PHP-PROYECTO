<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; // Importante para listar las categorías en el formulario
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardInventario()
    {
        // 1. Obtener métricas generales del catálogo
        $totalProductos = Producto::count();
        
        // Cuenta cuántas categorías distintas tienen productos asignados actualmente
        $totalCategorias = Producto::distinct('categoria_id')->count('categoria_id');

        // 2. Clasificación de niveles de stock
        $stockNormal = Producto::where('stock', '>', 5)->count();
        $stockBajo = Producto::whereBetween('stock', [1, 5])->count();
        $sinStock = Producto::where('stock', '<=', 0)->count();

        // 3. Calcular porcentaje con stock estable
        $porcentajeCatalogo = $totalProductos > 0 
            ? round(($stockNormal / $totalProductos) * 100) 
            : 0;

        // 4. Traer todos los productos con su categoría para listarlos en una tabla
        $productos = Producto::with('categoria')->get();
        
        // Traer todas las categorías disponibles para el formulario modal
        $categorias = Categoria::all();

        // Retornar la vista con todas las variables requeridas
        return view('admin.inventario', compact(
            'totalProductos',
            'totalCategorias',
            'stockNormal',
            'stockBajo',
            'sinStock',
            'porcentajeCatalogo',
            'productos',
            'categorias'
        ));
    }

    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Manejo de la subida de la imagen
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            $nombreImagen = time() . '.' . $request->imagen->extension();
            // Guarda de forma directa en public/images/productos para fácil acceso
            $request->imagen->move(public_path('images/productos'), $nombreImagen);
        }

        // Guardar el Producto en la base de datos
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $nombreImagen ? 'images/productos/' . $nombreImagen : null,
        ]);

        return redirect()->route('admin.inventario')->with('success', 'Producto agregado con éxito.');
    }
}
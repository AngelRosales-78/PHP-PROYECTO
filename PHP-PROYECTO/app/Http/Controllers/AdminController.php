<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Ahora sí funcionará sin errores
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboardInventario()
    {
        // 1. Contamos el total general de productos en la BD
        $totalProductos = Producto::count();

        // 2. Stock Normal: Productos que tienen más de 10 unidades disponibles
        $stockNormal = Producto::where('stock', '>', 10)->count();

        // 3. Stock Bajo: Tienen entre 1 y 10 unidades (Requieren reposición)
        $stockBajo = Producto::whereBetween('stock', [1, 10])->count();

        // 4. Sin Stock: Tienen 0 unidades exactas
        $sinStock = Producto::where('stock', '<=', 0)->count();

        // 5. Contar cuántas categorías únicas existen registradas en tu tabla
        $totalCategorias = Producto::distinct('categoria')->count('categoria');

        // Calculamos el porcentaje dinámico para la segunda tarjeta (Stock Normal)
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
}
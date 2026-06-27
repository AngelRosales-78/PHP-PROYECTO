<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; 
use App\Models\Pedido; // Importamos el modelo Pedido
use Illuminate\Http\Request;
use App\Models\Cliente;
class AdminController extends Controller
{
    /*
    | Gestión de Inventario
    */
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


    /*Database*/
    /*Database*/
    /*Database*/

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


    /**
     * Muestra la lista completa de pedidos para el administrador.
     */
    public function dashboardPedidos()
    {
        // Obtenemos todos los pedidos de la base de datos ordenados por el más reciente
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();
        
        // Retorna la vista pasándole la colección
return view('admin.pedidos', compact('pedidos'));    }

    /**
     * Procesa el cambio de estado mediante el elemento selector dinámico.
     */
    public function updateEstado(Request $request, $id)
    {
        // Validamos que el estado enviado sea uno de los permitidos por las reglas del negocio
        $request->validate([
            'estado' => 'required|in:Pendiente,Procesando,En Camino,Entregado,Cancelado'
        ]);

        // Buscamos el pedido o lanzamos error si no existe
        $pedido = Pedido::findOrFail($id);
        
        // Modificamos y guardamos el cambio
        $pedido->estado = $request->input('estado');
        $pedido->save();

        // Redireccionamos a la pantalla anterior enviando la confirmación de éxito
        return redirect()->back()->with('success', '¡Estado del pedido #' . $id . ' cambiado correctamente a ' . $pedido->estado . '!');
    }

public function dashboardUsuarios()
{
    $usuarios = \App\Models\User::orderBy('created_at', 'desc')->get();
    
    $totalUsuarios = $usuarios->count();

    return view('admin.usuarios', compact('usuarios', 'totalUsuarios'));
}
}
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PedidoController; 
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Rutas Principales y de Bienvenida
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/registro', function () {
    return view('crear-cuenta');
})->name('registro');

Route::post('/registro', [RegisterController::class, 'store'])->name('registro.store');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', function() {
    Session::forget(['cliente_id', 'cliente_nombre']);
    return redirect('/')->with('success', 'Sesión cerrada correctamente.');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Categorías y Tienda
|--------------------------------------------------------------------------
*/
Route::get('/categoria/comida-rapida', [CategoryController::class, 'comidaRapida'])->name('categoria.comida');
Route::get('/carrito/detalles', [CategoryController::class, 'detallesCompra'])->name('carrito.detalles');
Route::post('/pedido/procesar-qr', [PedidoController::class, 'mostrarPantallaQr'])->name('pedido.procesarQr');
Route::get('/categoria/libreria', [CategoryController::class, 'libreria'])->name('categoria.libreria');
Route::get('/categoria/supermercado', [CategoryController::class, 'supermercado'])->name('categoria.supermercado');
Route::get('/categoria/licores', [CategoryController::class, 'licores'])->name('categoria.licores');
Route::get('/categoria/farmacias', [CategoryController::class, 'farmacias'])->name('categoria.farmacias');
Route::post('/pedido/finalizar-guardar', [PedidoController::class, 'guardarPedido'])->name('pedido.guardar');

/*
|--------------------------------------------------------------------------
| Panel de Administración (ClickUp Admin)
|--------------------------------------------------------------------------
*/
Route::get('/admin/inventario', [AdminController::class, 'dashboardInventario'])->name('admin.inventario');
// Procesar el formulario y guardar el producto en la BD
Route::post('/admin/inventario/guardar', [AdminController::class, 'store'])->name('admin.productos.store');
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\PedidoProducto;
use App\Models\Rol;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/principal', function(){
    return view('admin');
});

Route::get('/logeo', function () {
    return view('logeo');
});

Route::get('/mapeo', function () {
    return view('pedidos.editacion');
});


Route::get('/prinped', function () {
    return view('pedidos');
});

Route::get('/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/prueba', function () {
});

//Productos
Route::get('/productos', [ProductoController::class, 'index'])->middleware('can:productos.listproductos')->name('productos.listproductos');
Route::get('/productos/create', [ProductoController::class, 'create'])->middleware('can:productos.createproducto')->name('productos.createproducto');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->middleware('can:productos.edit')->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->middleware('can:productos.destroy')->name('productos.destroy');

//Pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->middleware('can:pedidos.listpedidos')->name('pedidos.listpedidos');
Route::get('/pedidos/create', [PedidoController::class, 'create'])->middleware('can:pedidos.createpedido')->name('pedidos.createpedido');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos/{id}/edit', [PedidoController::class, 'edit'])->middleware('can:pedidos.edit')->name('pedidos.edit');
Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('pedidos.update');
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->middleware('can:pedidos.destroy')->name('pedidos.destroy');

//Empleados
//Listar y eliminar
Route::get('/usuarios', [UserController::class, 'index'])->middleware('can:usuarios.list')->name('usuarios.list');
Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->middleware('can:usuarios.edit')->name('usuarios.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->middleware('can:usuarios.destroy')->name('usuarios.destroy');


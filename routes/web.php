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

    /*$pedidos = Pedido::with('user.rols')->get(); // Obtener todos los pedidos con sus usuarios y roles asociados, Ademas se definen las relaciones involucradas(definir el nombre definido en el modelo)

    dd($pedidos); die();

foreach ($pedidos as $pedido) { // Recorrer todos los pedidos
    echo "<h1>".$pedido->user->name." ".$pedido->user->surname."</h1>"; // Mostrar el nombre y apellido del usuario asociado al pedido
    echo "<h2>".$pedido->user->rols->name_rol."</h2>"; // Mostrar el nombre del rol del usuario
    echo "<p>".$pedido->estado_ped."</p>"; // Mostrar el estado del pedido
}
die();*/

/*$users = User::with('rols', 'pedidos')->get(); // Obtener todos los usuarios con sus roles y pedidos asociados

foreach ($users as $user) { // Recorrer todos los usuarios
    echo "<h1>".$user->name." ".$user->surname."</h1>"; // Mostrar el nombre y apellido del usuario
    echo "<h2>".$user->rols->name_rol."</h2>"; // Mostrar el nombre del rol del usuario

    foreach ($user->pedidos as $pedido) { // Recorrer los pedidos del usuario
        echo "<p>".$pedido->estado_ped."</p>"; // Mostrar el estado del pedido
    }
}*/

//Mostrar todo los productos por categoria
/*
echo "<strong>Productos por categoria</strong>";

$producto = Producto::with('categorias')->get();

foreach($producto as $product){
    echo "<p>".$product->name_producto."</p>";
    echo "<p>".$product->categorias->name_cat."</p>";
    echo "<hr/>";
}

echo "<strong>Roles de usuarios</strong>";

$user = User::with('rols')->get();

foreach($user as $usuarios){
    echo "<p>".$usuarios->name."</p>";
    echo "<p>".$usuarios->rols->name_rol."</p>";
    echo "<hr/>";
}
*/
/*
echo "<strong>Productos por Pedido</strong>";

$pedidos = Pedido::with('productos')->get(); 

foreach ($pedidos as $pedido) { 
    echo "<h1>Pedido #".$pedido->id."</h1>"; 

    foreach ($pedido->productos as $producto) { 
        echo "<p>".$producto->name_producto."</p>"; 
    }

        echo "<hr/>";
}

/*$modelo = new PedidoProducto();
echo $modelo->getTable(); // Debería mostrar "pedidos_productos"
die();*/



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


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Rol;
use App\Models\User;

class PruebaController extends Controller
{
    public function muestra()
    {
        $rol = Rol::all();
        $categorias = Categoria::all();

        return view('muestra', compact('rol', 'categorias'));
    }
}

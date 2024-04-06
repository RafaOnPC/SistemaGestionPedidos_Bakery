<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto = Producto::all();
        $categorias = Categoria::all();
        return view('productos.official', compact('producto', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.creacion', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           // 'name_producto' => ['required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/'],
           //'descrip_prod' => ['required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/'],
            'name_producto' => ['required', 'string'],
            'descrip_prod' => ['required', 'string'],
            'stock' => 'required|numeric',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'name_producto.required' => 'El campo de nombre de producto es requerido.',
            'name_producto.regex' => 'El campo de nombre de producto debe ser una cadena de texto.',
            'descrip_prod.required' => 'El campo de descripcion del producto es requerido.',
            'descrip_prod.regex' => 'El campo de descripcion del producto debe ser una cadena de texto.',
            'stock.required' => 'El campo de stock es requerido.',
            'stock.numeric' => 'El campo de stock debe ser un numero.',
            'precio.required' => 'El campo del precio es requerido.',
            'precio.numeric' => 'El campo de precio debe ser un numero.',
        ]);
    
            $producto = new Producto();
            $producto->name_producto = $validatedData['name_producto'];
            $producto->descrip_prod = $validatedData['descrip_prod'];
            $producto->stock = $validatedData['stock'];
            $producto->precio = $validatedData['precio'];
            $producto->categoria_id = $validatedData['categoria_id'];
            $producto->save();
        
        return redirect()->route('productos.listproductos')->with('success', 'Producto agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('productos.editacion', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            //'name_producto' => ['required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/'],
            //'descrip_prod' => ['required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/'],
            'name_producto' => ['required', 'string'],
            'descrip_prod' => ['required', 'string'],
            'stock' => 'required|numeric',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'name_producto.required' => 'El campo de nombre de producto es requerido.',
            'name_producto.regex' => 'El campo de nombre de producto debe ser una cadena de texto.',
            'descrip_prod.required' => 'El campo de descripcion del producto es requerido.',
            'descrip_prod.regex' => 'El campo de descripcion del producto debe ser una cadena de texto.',
            'stock.required' => 'El campo de stock es requerido.',
            'stock.numeric' => 'El campo de stock debe ser un numero.',
            'precio.required' => 'El campo del precio es requerido.',
            'precio.numeric' => 'El campo de precio debe ser un numero.',
        ]);
    
        $producto = Producto::findOrFail($id);
        $producto->name_producto = $validatedData['name_producto'];
        $producto->descrip_prod = $validatedData['descrip_prod'];
        $producto->stock = $validatedData['stock'];
        $producto->precio = $validatedData['precio'];
        $producto->categoria_id = $validatedData['categoria_id'];
        $producto->save();
    
        return redirect()->route('productos.listproductos')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.listproductos')->with('success', 'Producto eliminado exitosamente.');
    }
}

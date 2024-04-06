<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pedidos\StoreOrderRequest;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\PedidoProducto;
use App\Models\User;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedido = Pedido::all();
        $productos = Producto::all();
        $usuarios = User::all();
        return view('pedidos.oficial', compact('pedido', 'usuarios', 'productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $usuarios = User::all();
        $productos = Producto::all();
        return view('pedidos.creacion', compact('productos','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valor = array();
                $productos = Producto::all();
                foreach($productos as $product){
                    $cantidad = $request->input('product_'.$product->id);
                    if($cantidad > $product->stock){
                        $message = 'Se esta excediendo el stock disponible';
                        return redirect()->route('pedidos.listpedidos')->with('msg', $message);
                    }
                    
                    if($cantidad != 0){
                        $valor[$product->id] = $cantidad;
                        $product->stock = $product->stock - $cantidad;
                        $product->update();

                    }
                }
       //Guardar pedido
            //Recoger datos del formulario
            $validatedData = $request->validate([
                'dir_envio' => 'required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/',
                'estado_ped' => 'required|in:E,P,F',
                'date_ped' => 'required|date',
                'user_id' => 'required',
            ], [
                'dir_envio.required' => 'El campo de dirección de envío es requerido.',
                'dir_envio.regex' => 'El campo de dirección de envío debe ser una cadena de texto.',
                'estado_ped.required' => 'El campo de estado de pedido es requerido.',
                'date_ped.required' => 'El campo de fecha es requerido',
                'user_id.required' => 'El campo de usuario es requerido.',
            ]);

                $pedido = new Pedido();
                $pedido->dir_envio =  $validatedData['dir_envio'];
                $pedido->estado_ped =  $validatedData['estado_ped'];
                $pedido->date_ped =  $validatedData['date_ped'];
                $pedido->user_id = $validatedData['user_id'];
                $pedido->save();
            
            foreach($valor as $id => $product){
                $pedido_producto = new PedidoProducto();
                $pedido_producto->ped_id = $pedido->id;
                $pedido_producto->prod_id = $id;
                $pedido_producto->cant = $product;
                $total = ($pedido_producto->cant * $productos->find($id)->precio);
                $pedido_producto->total = $total;
                $pedido_producto->save();
            }  

            return redirect()->route('pedidos.listpedidos')->with('success', 'Pedido agregado correctamente');
       
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
        
        //Recoger el id del pedido
        //Encontrar el pedido por id
        $pedido = Pedido::findOrFail($id);
        $usuarios = User::all();
        $productos = Producto::all();

        return view('pedidos.editacion',compact('pedido', 'productos', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Recoger los datos del formulario a modificar
        $validatedData = $request->validate([
            'dir_envio' => ['required', 'regex:/^[a-zA-Z\d]+\s[\w\s]+$/'],
            'estado_ped' => 'required|in:E,P,F',
            'date_ped' => 'required|date',
            'user_id' => 'required',
        ], [
            'dir_envio.required' => 'El campo de dirección de envío es requerido.',
            'dir_envio.regex' => 'El campo de dirección de envío debe ser una cadena de texto.',
            'estado_ped.required' => 'El campo de estado de pedido es requerido.',
            'date_ped.required' => 'El campo de fecha es requerido',
            'user_id.required' => 'El campo de usuario es requerido.',
        ]);

        //Actualizar los datos a modificar
            //Encontrar el pedido existente para su modificacion
        $pedido = Pedido::find($id);
        $pedido->dir_envio =  $validatedData['dir_envio'];
        $pedido->estado_ped =  $validatedData['estado_ped'];
        $pedido->date_ped =  $validatedData['date_ped'];
        $pedido->user_id = $validatedData['user_id'];
        $pedido->save();

        
        $pedidoProducto = PedidoProducto::where('ped_id', $pedido->id)->get(); 
        $pedido_producto =  array();
        foreach($pedidoProducto as $key => $value){
            $pedido_producto[$key] = $pedidoProducto[$key]->getAttributes(); 
        }

        //EL array_registro recoge la cantidad comprada de cada producto por un pedido
        for($i=0;$i<count($pedido_producto);$i++){
            $array_registro[$pedidoProducto[$i]->prod_id] = $pedidoProducto[$i]->cant;
        }

        //EL array_formulario recoge la cantidad a comprar ACTUALIZADA de cada producto por un pedido 
        $productos = Producto::all();
        foreach($productos as $product){
            $cantidad = intval($request->input('product_' . $product->id));
            if($cantidad > 0){
                $array_formulario[$product->id] = $cantidad;
            } 
        }

        foreach($array_formulario as $indice => $valor) {
            if (array_key_exists($indice, $array_registro) && $array_formulario[$indice] != $array_registro[$indice]) {
           
                $producto = Producto::find($indice);
                $pedidoProducto = PedidoProducto::where('ped_id', $pedido->id)
                ->where('prod_id', $indice)
                ->first();

                //Gestion de Stock de productos
                    if($array_formulario[$indice] > $producto->stock){
                        $message = 'Se esta excediendo el stock disponible';
                        $pedidoProducto->ped_id = $pedido->id;
                        $pedidoProducto->prod_id = $indice;
                        $pedidoProducto->cant = $array_registro[$indice];
                        $pedidoProducto->total = $array_registro[$indice] * $producto->precio;
                        $pedidoProducto->update();
                        return redirect()->route('pedidos.edit',$pedido->id)->with('msg', $message);
                    }
                    
                    if($array_formulario[$indice] < $array_registro[$indice]){

                        $diferencia = $array_registro[$indice] - $array_formulario[$indice];
                        $producto->stock = $producto->stock + $diferencia;
                        $producto->update();

                        $pedidoProducto->ped_id = $pedido->id;
                        $pedidoProducto->prod_id = $indice;
                        $pedidoProducto->cant = $array_formulario[$indice];
                        $pedidoProducto->total = $array_formulario[$indice] * $producto->precio;
                        $pedidoProducto->update();

                    }else if($array_formulario[$indice] > $array_registro[$indice] && $array_formulario[$indice] < $producto->stock){
                        
                        $producto->stock = $producto->stock - $array_formulario[$indice];
                        $producto->update();

                        $pedidoProducto->ped_id = $pedido->id;
                        $pedidoProducto->prod_id = $indice;
                        $pedidoProducto->cant = $array_formulario[$indice];
                        $pedidoProducto->total = $array_formulario[$indice] * $producto->precio;
                        $pedidoProducto->update();

                    }

            }else if(!array_key_exists($indice, $array_registro)){
                

                //Crear un nuevo registro asociado al pedido en la tabla PedidoProducto
                $pedidoProductos = new PedidoProducto();
                $pedidoProductos->ped_id = $pedido->id;
                $pedidoProductos->prod_id = $indice;
                $pedidoProductos->cant = $array_formulario[$indice];
                $producto = Producto::find($indice);
                $pedidoProductos->total = $array_formulario[$indice] * $producto->precio;
                $pedidoProductos->save();

                if($array_formulario[$indice] > $producto->stock){
                    $message = 'Se esta excediendo el stock disponible';
                    return redirect()->route('pedidos.edit',$pedido->id)->with('msg', $message);
                }

                //Gestion de Stock para nuevo producto agregado
                $producto->stock = $producto->stock - $array_formulario[$indice];
                $producto->update();
                

            }
        }

        return redirect()->route('pedidos.listpedidos')->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Encontrar el pedido a eliminar
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedidos.listpedidos')->with('success','Pedido eliminado correctamente');
        
    }

    

    
}

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
        //return view('pedidos.createpedido', compact('productos','usuarios'));
        return view('pedidos.creacion', compact('productos','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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

        //Capturando cantidades compradas por cada producto
                $valor = array();
                $productos = Producto::all();
                foreach($productos as $product){
                    $cantidad = $request->input('product_'.$product->id);
                    if($cantidad > $product->stock){
                        $message = 'Se esta excediendo el stock disponible';
                        return redirect()->route('pedidos.createpedido')->with('msg', $message);
                    }
                    
                    if($cantidad != 0){
                        $valor[$product->id] = $cantidad;
                        $product->stock = $product->stock - $cantidad;
                        $product->update();

                    }

                    /* if($cantidad != 0){
                        $valor[$product->id] = $cantidad;
                    } */
                }

        //Guardar productos en el pedido guardado
            //Encontrar el pedido guardado y agregar datos de productos al pedido
            //$pedido = Pedido::findOrFail($pedido->id);
            
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
        //dd($request->all());
        //recoger los datos del formulario a modificar
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
        $pedido = Pedido::findOrFail($id);
        $pedido->dir_envio =  $validatedData['dir_envio'];
        $pedido->estado_ped =  $validatedData['estado_ped'];
        $pedido->date_ped =  $validatedData['date_ped'];
        $pedido->user_id = $validatedData['user_id'];
        $pedido->save();

        

        //Actualizar los datos de los productos del pedido
        $productos = Producto::all();

        //Encontrar el registro de PedidosProductos asociado al pedido existente
        //$pedidoProducto = PedidoProducto::where('ped_id', $pedido->id);
        $pedidoProducto = PedidoProducto::where('ped_id', $pedido->id)->get(); // Me devuelve un array normal con indice de acuerdo a la cantidad 
        // de pedidos productos asociados



        //dd($pedidoProducto);

        if(!$pedidoProducto){
            $pedidoProducto = new PedidoProducto();
            $pp = true;
        }


        $cont = 0;
                
        foreach($productos as $producto) {
            //$cantidad = $request->input('product_'.$producto->id);
            $cont += 1;
            //dd($request->input('product_' . $producto->id));
            $cantidad = intval($request->input('product_' . $producto->id));
            if($cantidad > $producto->stock){
                $message = 'Se esta excediendo el stock disponible';
                return redirect()->route('pedidos.edit',$pedido->id)->with('msg', $message);
            }

        //Actualizacion de campos correspondientes al producto
        //Manejo de Stock de productos por pedido actualizado
            $cantidad_inicial = $pedidoProducto->cant;
            
            if($cantidad < $cantidad_inicial){
                $diferencia = $cantidad_inicial - $cantidad;
                $producto->stock = $producto->stock + $diferencia;
                $producto->update();
            }else if($cantidad > $cantidad_inicial){
                $producto->stock = $producto->stock - $cantidad;
                $producto->update();
            }

            if($pp){
                $pedidoProducto->ped_id = $pedido->id;
                $pedidoProducto->prod_id = $producto->prod_id;
                $pedidoProducto->cant = $cantidad;
                $pedidoProducto->total = $cantidad * $producto->precio;
                $pedidoProducto->save();
            }else{
                $pedidoProducto->ped_id = $pedido->id;
                $pedidoProducto->prod_id = $producto->prod_id;
                $pedidoProducto->cant = $cantidad;
                $pedidoProducto->total = $cantidad * $producto->precio;
                $pedidoProducto->update();
            }
            
        }

        dd($cont);

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

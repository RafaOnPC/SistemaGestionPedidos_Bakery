<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $fillable = [
        'name_producto',
        'descrip_prod',
        'stock',
        'precio',
        'categoria_id',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedidos_productos', 'prod_id', 'ped_id');
    }

    public function pedidosproductos()
    {
        return $this->hasMany(PedidoProducto::class, 'prod_id');
    }

    /* 
    public function pedidos()
    {
        return $this->hasMany(PedidoProducto::class, 'prod_id');
        //return $this->belongsToMany(Pedido::class, 'pedidos_productos', 'prod_id', 'ped_id');
    }
    */

    /*public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedidos_productos', 'prod_id', 'ped_id');
    }*/

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    use HasFactory;

    protected $table = 'pedidos_productos';


    protected $fillable = [
        'ped_id',
        'prod_id',
        'cant',
        'total',
    ];


/* 
    /public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function productos()
    {
        return $this->belongsTo(Producto::class);
    }
    */

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'prod_id');
    }
}

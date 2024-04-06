<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'dir_envio',
        'estado_ped',
        'date_ped',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /* public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedidos_productos', 'ped_id', 'prod_id');
    } */

    /*public function productos()
    {
        //return $this->hasMany(PedidoProducto::class); 
        return $this->belongsToMany(Producto::class, 'pedidos_productos', 'ped_id');
    }*/

    /*public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedidos_productos', 'prod_id', 'ped_id');
    }
    */

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedidos_productos', 'ped_id', 'prod_id');
    }
 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'cliente_nombre', 'total', 'estado'];

    // Un pedido puede tener muchos detalles de productos
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'producto',
        'cantidad',
        'stock_minimo',
        'ubicacion',
        'observaciones'
    ];
}
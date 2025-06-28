<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Habitacion;
use App\Models\Cliente;


class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'habitacion_id',
        'cliente_id',
        'fecha_ingreso',
        'fecha_salida',
        'estado',
        'total',
        'observaciones',
    ];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

 public function cliente()
{
    return $this->belongsTo(Cliente::class);
}

public function factura()
{
    return $this->hasOne(Factura::class);
}


}

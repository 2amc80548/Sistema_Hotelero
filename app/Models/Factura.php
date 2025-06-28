<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'fecha_emision',
        'total',
        'metodo_pago',
        'archivo_pdf',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}

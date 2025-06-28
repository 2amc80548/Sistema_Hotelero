<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cliente extends Model
{
    use HasFactory;

    // Campos que pueden ser asignados masivamente (fillables)
    protected $fillable = [
        'nombre',
        'documento_identidad',
        'telefono',
        'email',
        'direccion',
    ];
public function reservas()
{
    return $this->hasMany(Reserva::class);
}



}

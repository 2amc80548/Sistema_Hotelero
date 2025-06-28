<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id();

        $table->foreignId('habitacion_id')->constrained('habitaciones')->onDelete('cascade');
      
 

        $table->string('nombre_cliente'); // en caso de no tener el módulo Cliente aún
        $table->date('fecha_ingreso');
        $table->date('fecha_salida');
        $table->enum('estado', ['pendiente', 'confirmada', 'finalizada', 'cancelada'])->default('pendiente');
        $table->decimal('total', 10, 2)->default(0);
        $table->text('observaciones')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};

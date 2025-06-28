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
    Schema::create('habitaciones', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique(); // ej: 101, 102
        $table->enum('tipo', ['simple', 'doble', 'suite']);
        $table->decimal('precio', 8, 2);
        $table->enum('estado', ['disponible', 'reservada', 'ocupada', 'limpieza'])->default('disponible');
        $table->string('piso')->nullable(); // opcional
        $table->text('observaciones')->nullable(); // opcional
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacions');
    }
};

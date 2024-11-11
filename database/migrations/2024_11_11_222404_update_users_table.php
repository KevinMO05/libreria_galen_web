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
        Schema::table('users', function (Blueprint $table) {
            // Agregar columna para la relación con el rol
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');

            // Agregar columnas adicionales
            $table->string('address', 255)->nullable(); // Dirección
            $table->string('phone', 9); // Teléfono
            $table->string('dni', 8)->unique()->nullable(); // DNI
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar las columnas agregadas
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'address', 'phone', 'dni']);
        });
    }
};

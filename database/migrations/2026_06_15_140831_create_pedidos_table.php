<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla principal de pedidos
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            // Relación con tu tabla de clientes usando la sesión
            $table->unsignedBigInteger('cliente_id')->nullable(); 
            $table->string('cliente_nombre');
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('Pendiente');
            $table->timestamps();
        });

        // Tabla de detalles del pedido
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->string('producto_nombre');
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_detalles');
        Schema::dropIfExists('pedidos');
    }
};
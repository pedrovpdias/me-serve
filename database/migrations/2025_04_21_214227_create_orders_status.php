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
        Schema::create('orders_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable(); // Ex: 'Em preparação', 'Entregue'...
            $table->integer('order')->default(0); // Ordem de exibição
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_status');
    }
};

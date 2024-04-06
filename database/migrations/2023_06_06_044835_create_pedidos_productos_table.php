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
        Schema::create('pedidos_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ped_id')->constrained('pedidos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('prod_id')->constrained('productos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('cant');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_productos');
    }
};

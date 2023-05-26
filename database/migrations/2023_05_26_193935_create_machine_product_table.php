<?php

use App\Models\Machine;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('machine_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Machine::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->float('price');
            $table->unsignedInteger('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines_products');
    }
};

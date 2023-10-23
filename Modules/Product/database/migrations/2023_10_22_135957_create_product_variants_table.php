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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            //
            $table->char('barcode')->nullable();
            $table->decimal('size')->nullable(); // move to Size (module) & change field to size_id (foreign key)
            $table->foreignUuid('unit_code')->nullable();
            //
            $table->timestamps();

            $table->unique(['product_id', 'barcode', 'size'], 'variant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};

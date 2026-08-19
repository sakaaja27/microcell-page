<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('schema_id')->nullable()->constrained('schemas')->nullOnDelete();
            $table->string('customer');
            $table->string('skema');
            $table->integer('qty');
            $table->decimal('total', 15, 0);
            $table->string('status')->default('Menunggu');
            $table->string('tanggal');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
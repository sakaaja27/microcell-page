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
        Schema::table('schemas', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('satuan');
            $table->string('badge')->nullable()->after('subtitle');
            $table->string('icon')->nullable()->after('badge');
            $table->json('features')->nullable()->after('icon');
            $table->boolean('is_recommended')->default(false)->after('features');
            $table->string('cta_text')->default('Hubungi Kami')->after('is_recommended');
            $table->string('cta_link')->default('#')->after('cta_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemas', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'badge', 'icon', 'features', 'is_recommended', 'cta_text', 'cta_link']);
        });
    }
};

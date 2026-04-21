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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('has_variants')->default(false)->after('is_featured');
            $table->string('sku', 100)->nullable()->unique()->after('has_variants');
            $table->integer('stock_qty')->default(0)->after('sku');
            $table->integer('min_stock')->default(5)->after('stock_qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['has_variants', 'sku', 'stock_qty', 'min_stock']);
        });
    }
};

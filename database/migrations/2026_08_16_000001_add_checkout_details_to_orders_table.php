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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'product_name')) {
                $table->string('product_name')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('orders', 'delivery_option')) {
                $table->string('delivery_option')->nullable()->after('delivery_date');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'product_name')) {
                $table->dropColumn('product_name');
            }

            if (Schema::hasColumn('orders', 'delivery_option')) {
                $table->dropColumn('delivery_option');
            }
        });
    }
};

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
            if (!Schema::hasColumn('orders', 'flavor')) {
                $table->string('flavor')->nullable()->after('cake_size');
            }

            if (!Schema::hasColumn('orders', 'frosting')) {
                $table->string('frosting')->nullable()->after('flavor');
            }

            if (!Schema::hasColumn('orders', 'design_image')) {
                $table->string('design_image')->nullable()->after('delivery_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'design_image')) {
                $table->dropColumn('design_image');
            }

            if (Schema::hasColumn('orders', 'frosting')) {
                $table->dropColumn('frosting');
            }

            if (Schema::hasColumn('orders', 'flavor')) {
                $table->dropColumn('flavor');
            }
        });
    }
};

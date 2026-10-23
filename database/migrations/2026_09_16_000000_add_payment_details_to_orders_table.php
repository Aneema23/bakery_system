<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'advance_amount')) {
                $table->decimal('advance_amount', 10, 2)->nullable()->after('total_price');
            }

            if (!Schema::hasColumn('orders', 'transaction_id')) {
                $table->string('transaction_id', 100)->nullable()->after('advance_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }

            if (Schema::hasColumn('orders', 'advance_amount')) {
                $table->dropColumn('advance_amount');
            }
        });
    }
};

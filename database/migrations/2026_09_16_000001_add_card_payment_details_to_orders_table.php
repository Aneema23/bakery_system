<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'card_type')) {
                $table->string('card_type', 20)->nullable()->after('transaction_id');
            }

            if (!Schema::hasColumn('orders', 'card_last_four')) {
                $table->string('card_last_four', 4)->nullable()->after('card_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'card_last_four')) {
                $table->dropColumn('card_last_four');
            }

            if (Schema::hasColumn('orders', 'card_type')) {
                $table->dropColumn('card_type');
            }
        });
    }
};

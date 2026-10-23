<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('delivery_person_id')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->nullOnDelete();
            $table->string('priority')->default('normal')->after('delivery_person_id');
            $table->text('delivery_notes')->nullable()->after('priority');
            $table->decimal('latitude', 10, 7)->nullable()->after('delivery_notes');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['delivery_person_id']);
            $table->dropColumn([
                'delivery_person_id',
                'priority',
                'delivery_notes',
                'latitude',
                'longitude',
            ]);
        });
    }
};

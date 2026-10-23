<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nic')->nullable()->after('city');
            $table->string('vehicle_type')->nullable()->after('nic');
            $table->string('status')->default('Active')->after('vehicle_type');
            $table->string('photo')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nic', 'vehicle_type', 'status', 'photo']);
        });
    }
};
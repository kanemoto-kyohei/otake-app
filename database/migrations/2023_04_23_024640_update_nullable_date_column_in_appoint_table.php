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
        Schema::table('appoint', function (Blueprint $table) {
            //
            $table->string('date')->nullable()->change();
            $table->string('time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appoint', function (Blueprint $table) {
            //
            $table->string('date')->nullable(false)->change();
            $table->string('time')->nullable(false)->change();
        });
    }
};

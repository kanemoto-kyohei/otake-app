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
            $table->dropColumn('is_admin');
            $table->string('name');
            $table->string('email');
            $table->text('extra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appoint', function (Blueprint $table) {
            //
        });
    }
};

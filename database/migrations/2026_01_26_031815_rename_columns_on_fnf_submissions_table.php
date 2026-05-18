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
          Schema::table('fnf_submissions', function (Blueprint $table) {
            $table->renameColumn('fullname', 'referal5');
            $table->renameColumn('phone', 'referal6');
            $table->renameColumn('instagram', 'referal7');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fnf_submissions', function (Blueprint $table) {
            $table->renameColumn('referal5', 'fullname');
            $table->renameColumn('referal6', 'phone');
            $table->renameColumn('referal7', 'instagram');
        });
    }
};

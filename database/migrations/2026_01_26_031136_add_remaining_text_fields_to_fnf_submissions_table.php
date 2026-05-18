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
    $table->string('referal2')->nullable();
    $table->string('referal3')->nullable();
    $table->text('referal4')->nullable();
    
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fnf_submissions', function (Blueprint $table) {
            $table->dropColumn([
                
                'referal2',
                'referal3',
                'referal4',
            ]);
        });
    }
};

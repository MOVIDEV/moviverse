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
        Schema::create('reward_claims', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                ->constrained('fnf_submissions')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->tinyInteger('tier');
            $table->tinyInteger('step'); // 1 atau 2

            $table->string('claim_code')->unique();

            $table->tinyInteger('status')->default(0);
            /*
                0 = claimed (user baru klik)
                1 = proses (admin kirim reward)
                2 = done (selesai)
            */

            $table->timestamps();

            // ⛔ anti double claim di step yg sama
            $table->unique(['submission_id', 'step']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reward_claims');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistents', function (Blueprint $table) {
            $table->id();
            $table->string('asistent');
            $table->integer('companie_id');
            $table->integer('petition_id');
            $table->integer('job_id');
            $table->integer('review_id');
            $table->integer('search_id');
            $table->integer('profile_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        for ($i = 1; $i <= 20; $i++) {
            DB::table('asistents')->insert([
                'asistent' => "asisten number $i",
                'companie_id' => $i,
                'petition_id' => $i,
                'job_id' => $i,
                'review_id' => $i,
                'search_id' => $i,
                'profile_id' => $i,
                'user_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistents');
    }
};

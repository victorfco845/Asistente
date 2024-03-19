<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->string('petition');
            $table->string('friend');
            $table->timestamps();
        });

        $friendNames = [
            'John Doe',
            'Jane Smith',
            'Robert Johnson',
            'Emily Davis',
            'Michael Wilson',
            'Olivia Brown',
            'David Taylor',
            'Sophia Anderson',
            'James Miller',
            'Ava Jackson',
            'William Harris',
            'Emma White',
            'Daniel Martin',
            'Isabella Clark',
            'Matthew Young',
            'Grace Thomas',
            'Andrew Hall',
            'Chloe Turner',
            'Christopher Walker',
            'Ella Baker',
        ];

        foreach ($friendNames as $friendName) {
            DB::table('petitions')->insert([
                'petition' => 'Send friend request',
                'friend' => $friendName,
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
        Schema::dropIfExists('petitions');
    }
};

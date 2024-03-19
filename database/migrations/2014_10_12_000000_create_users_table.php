<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $userNames = [
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

        foreach ($userNames as $userName) {
            $email = strtolower(str_replace(' ', '.', $userName)) . '@gmail.com';
            $password = Hash::make('1234');

            DB::table('users')->insert([
                'name' => $userName,
                'email' => $email,
                'password' => $password,
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
        Schema::dropIfExists('users');
    }
};
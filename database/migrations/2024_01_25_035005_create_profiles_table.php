<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('exp_job');
            $table->timestamps();
        });

        // Nombres y experiencias laborales
        $names = [
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

        $exp_jobs = [
            '3 meses',
            '6 meses',
            '1 año',
            '2 años',
            '4 meses',
            '9 meses',
            '1.5 años',
            '8 meses',
            '3 años',
            '1.5 años',
            '2.5 años',
            '6 meses',
            '1 año',
            '2 años',
            '4 meses',
            '1.5 años',
            '5 meses',
            '2 años',
            '1 año',
            '2.5 años',
        ];

        // Insertar los registros
        for ($i = 0; $i < count($names); $i++) {
            DB::table('profiles')->insert([
                'name' => $names[$i],
                'exp_job' => $exp_jobs[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

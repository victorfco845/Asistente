<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('companie');
            $table->string('description'); 
            $table->timestamps();
        });

        $companyNames = [
            'ABC Corporation',
            'XYZ Ltd.',
            'Tech Innovators Inc.',
            'Global Solutions Co.',
            'Green Energy Enterprises',
            'Dynamic Tech Solutions',
            'Creative Minds Agency',
            'Pinnacle Industries',
            'Infinite Innovations',
            'Future Builders Ltd.',
            'EcoTech Ventures',
            'Strategic Solutions Group',
            'Visionary Technologies Inc.',
            'Swift Logistics Services',
            'Quantum Computing Systems',
            'Digital Harmony Ltd.',
            'Alpha Omega Software',
            'Peak Performance Consultants',
            'United Global Enterprises',
        ];

        $description = [
            'Software Developer',
            'Marketing Specialist',
            'Project Manager',
            'Graphic Designer',
            'Data Analyst',
            'HR Consultant',
            'Financial Analyst',
            'UX/UI Designer',
            'Network Engineer',
            'Sales Representative',
            'Systems Administrator',
            'Content Writer',
            'Business Analyst',
            'Social Media Manager',
            'Database Administrator',
            'Customer Support Specialist',
            'Quality Assurance Tester',
            'Product Manager',
            'IT Consultant',
            'Event Coordinator',
        ];

        for ($i = 0; $i < count($companyNames); $i++) {
            DB::table('companies')->insert([
                'companie' => $companyNames[$i],
                'description' => $description[$i],
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
        Schema::dropIfExists('companies');
    }
};
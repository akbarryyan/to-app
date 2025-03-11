<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('tryouts')->insert([
            [
                'name' => 'UTBK 2025',
                'description' => 'Tryout simulasi UTBK untuk persiapan SNMPTN',
                'image' => 'avatars/utbk.jpg',
                'price' => 0,
                'is_paid' => 0,
                'start_date' => '2025-03-11 00:00:00',
                'end_date' => '2025-03-18 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CPNS Premium',
                'description' => 'Tryout CPNS dengan soal premium',
                'image' => null,
                'price' => 50000,
                'is_paid' => 1,
                'start_date' => '2025-03-11 00:00:00',
                'end_date' => '2025-03-16 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

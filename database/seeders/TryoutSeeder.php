<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TryoutSeeder extends Seeder
{
    public function run()
    {
        DB::table('tryouts')->insert([
            [
                'name' => 'Free Tryout 1',
                'description' => 'This is a free tryout.',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(7)->toDateString(),
                'price' => 0.00,
                'is_paid' => false,
                'image' => 'images/tryouts/free_tryout_1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Paid Tryout 1',
                'description' => 'This is a paid tryout.',
                'start_date' => null,
                'end_date' => null,
                'price' => 19.99,
                'is_paid' => true,
                'image' => 'images/tryouts/paid_tryout_1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Free Tryout 2',
                'description' => 'This is another free tryout.',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(14)->toDateString(),
                'price' => 0.00,
                'is_paid' => false,
                'image' => 'images/tryouts/free_tryout_2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Paid Tryout 2',
                'description' => 'This is another paid tryout.',
                'start_date' => null,
                'end_date' => null,
                'price' => 29.99,
                'is_paid' => true,
                'image' => 'images/tryouts/paid_tryout_2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

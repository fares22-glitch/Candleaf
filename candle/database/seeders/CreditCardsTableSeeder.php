<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('credit_cards')->insert([
            [
                'card_number' => '4111111111111111',
                'holder_name' => 'fares',
                'expiration' => '12/25',
                'cvv' => '123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'card_number' => '5500000000000004',
                'holder_name' => 'ahmed',
                'expiration' => '12/25',
                'cvv' => '123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

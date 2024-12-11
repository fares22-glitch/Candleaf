<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Coupon::create([
            'user_id' => 1,
            'coupon_code' => 'FARESJO',
            'discount' => 10.00,
            'usage_count' => 0,
        ]);
    }
}

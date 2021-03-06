<?php

namespace Tir\Store\Coupon\Database\Seeders;

use Illuminate\Database\Seeder;
use Tir\Store\Coupon\Entities\Coupon;

class CouponDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coupon::class, 10)->create();
    }
}

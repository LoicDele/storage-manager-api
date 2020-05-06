<?php

use Illuminate\Database\Seeder;
use App\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PaymentType::class, 100)->create()->each(function ($paymentType) {
            $paymentType->save();
        });
    }
}

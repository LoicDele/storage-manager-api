<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\PaymentType;

class PaymentTypeTest extends TestCase
{
    /**
     * GET /paymentTypes
    */
    public function testIndex()
    {
        $this->json("get", "/paymentTypes");
        $this->assertResponseOk();
    }
    /**
     * GET /paymentTypes/{id}
     */
    public function testShow()
    {
        $id = PaymentType::all()->random()->id;
        $this->json("get", "/paymentTypes/{$id}");
        $this->assertResponseOk();
    }
    /**
     * POST /paymentTypes
     */
    public function testCreate()
    {
        $paymentType = factory(PaymentType::class)->create();
        if(PaymentType::where('name', '=', $paymentType->name) == null)
        {
            $this->json("post", "/paymentTypes", $paymentType->toArray());
            $this->assertResponseOk();
        }
        else
        {
            $this->json("post", "/paymentTypes", $paymentType->toArray());
            $this->assertResponseStatus(422);
        }
    }
}

<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\PaymentType;

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
        $paymentType = factory(PaymentType::class)->raw();
        if(PaymentType::where('name', '=', $paymentType['name'])->first() == null)
        {
            $this->json("post", "/paymentTypes", $paymentType);
            $this->assertResponseOk();
            $this->seeInDatabase('payment_types', $paymentType);
        }
        else
        {
            $this->json("post", "/paymentTypes", $paymentType);
            $this->assertResponseStatus(422);
        }
    }
    /**
     * PUT /paymentTypes/{id}
     */
    public function testUpdate()
    {
        $paymentType = PaymentType::all()->random();
        $update = factory(PaymentType::class)->raw();
        if(PaymentType::where('name', '=', $update['name'])->first() == null or $update['name'] == $paymentType->name)
        {
            $this->json("put", "/paymentTypes/{$paymentType->id}", $update);
            $this->assertResponseOk();
            $this->seeInDatabase('payment_types', $update);
        }
        else
        {
            $this->json("put", "/paymentTypes/{$paymentType->id}", $update);
            $this->assertResponseStatus(422);
        }
    }
    /**
     * DELETE /paymentTypes/{id}
     */
    public function testDelete()
    {
        $paymentType = PaymentType::all()->random();
        $this->json("delete", "/paymentTypes/{$paymentType->id}");
        $this->assertResponseOk();
        $this->notSeeInDatabase('payment_types', $paymentType->toArray());
    }
}

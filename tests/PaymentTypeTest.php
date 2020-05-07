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
        $paymentType = factory(PaymentType::class)->create();
        if(PaymentType::where('name', '=', $paymentType->name) == null)
        {
            $this->json("post", "/paymentTypes", $paymentType->toArray());
            $this->assertResponseOk();
            $this->seeInDatabase('payment_types', $paymentType->toArray());
        }
        else
        {
            $this->json("post", "/paymentTypes", $paymentType->toArray());
            $this->assertResponseStatus(422);
        }
    }
    /**
     * PUT /paymentTypes/{id}
     */
    public function testUpdate()
    {
        $paymentType = PaymentType::all()->random();
        $update = factory(PaymentType::class)->create();
        if(PaymentType::where('name', '=', $update->name) == null or $update->name == $paymentType->name)
        {
            $this->json("put", "/paymentTypes/{$paymentType->id}", $update->toArray());
            $this->assertResponseOk();
            $this->seeInDatabase('payment_types', $update->toArray());
        }
        else
        {
            $this->json("put", "/paymentTypes/{$paymentType->id}", $update->toArray());
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

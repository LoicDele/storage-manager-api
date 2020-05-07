<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Transaction;

class TransactionTest extends TestCase
{
    /**
     * GET /transactions
     */
    public function testIndex()
    {
        $this->json("get", "/transactions");
        $this->assertResponseOk();
    }
    /**
     * get /transactions/{id}
     */
    public function testShow()
    {
        $id = Transaction::all()->random()->id;
        $this->json("get", "/transactions/{$id}");
        $this->assertResponseOk();
    }
    /**
     * post /transactions
     */
    public function testCreate()
    {
        $transaction = factory(Transaction::class)->create();
        $this->json("post", "/transactions", $transaction->toArray());
        $this->assertResponseOk();
    }
    /**
     * update /transactions/{id}
     */
    public function testUpdate()
    {
        $update = factory(Transaction::class)->create();
        $id = Transaction::all()->random()->id;
        $this->json("put", "/transactions/{$id}", $update->toArray());
        $this->assertResponseOk();
    }
    /**
     * delete /transactions/{id}
     */
    public function testDelete()
    {
        $id = Transaction::all()->random()->id;
        $this->json("delete", "/transactions/{$id}");
        $this->assertResponseOk();
    }
}

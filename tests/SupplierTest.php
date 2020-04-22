<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SupplierTest extends TestCase
{
    /**
     * GET /productSupplier
     */
    public function testIndex()
    {
        $this->json("get", '/productSuppliers');
        $this->assertResponseOk();
    }
    /**
     * GET /productSupplier/{id}
     */
    public function testShow()
    {
        $id = \App\Supplier::all()->random()->id;
        $this->json("get", "/productSuppliers/{$id}");
        $this->assertResponseOk();
    }
}

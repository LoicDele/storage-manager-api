<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Supplier;

class SupplierTest extends TestCase
{
    /**
     * GET /productSuppliers
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
    /**
     * POST /productSuppliers
     */
    public function testCreate()
    {
        $newSupplier = factory(Supplier::class)->create();
        if(Supplier::where('name', '=', $newSupplier->name)->first() == null)
        {
            $this->json("post", "/productSuppliers", $newSupplier->toArray());
            $this->assertResponseOk();
            $this->seeInDatabase("suppliers", $newSupplier);
        }
        else
        {
            $this->json("post", "/productSuppliers", $newSupplier->toArray());
            $this->assertResponseStatus(422);
        }

    }
    /**
     * PUT /productSuppliers/{id}
     */
    public function testUpdate()
    {
        $supplier = Supplier::all()->random();
        $update = factory(Supplier::class)->raw();
        $this->json("put", "/productSuppliers/{$supplier->id}", $update);
        $this->assertResponseOk();
        $this->seeInDatabase("suppliers", $update);
    }
    /**
     * DELETE /productSuppliers/{id}
     */
    public function testDelete()
    {
        $supplier = Supplier::all()->random();
        $this->json("delete", "/productSuppliers/{$supplier->id}");
        $this->assertResponseOk();
        $this->notSeeInDatabase("suppliers", $supplier->toArray());
    }
}

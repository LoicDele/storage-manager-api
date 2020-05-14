<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Supplier;

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
        $id = Supplier::all()->random()->id;
        $this->json("get", "/productSuppliers/{$id}");
        $this->assertResponseOk();
    }
    /**
     * POST /productSuppliers
     */
    public function testCreate()
    {
        $newSupplier = factory(Supplier::class)->raw();
        if(Supplier::where('name', '=', $newSupplier['name'])->first() == null)
        {
            $this->json("post", "/productSuppliers", $newSupplier);
            $this->assertResponseOk();
            $this->seeInDatabase('suppliers', $newSupplier);
        }
        else
        {
            $this->json("post", "/productSuppliers", $newSupplier);
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
        if(Supplier::where('name', '=', $update['name'])->first() == null or $supplier->name == $update['name'])
        {
            $this->json("put", "/productSuppliers/{$supplier->id}", $update);
            $this->assertResponseOk();
            $this->seeInDatabase("suppliers", $update);
        }
        else
        {
            $this->json("put", "/productSuppliers/{$supplier->id}", $update);
            $this->assertResponseStatus(422);
        }

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

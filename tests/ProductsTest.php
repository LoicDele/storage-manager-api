<?php

use App\Models\Product;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsTest extends TestCase
{
    /**
     * GET /products
     */
    public function testIndex()
    {
        $this->json("get", "/products");
        $this->assertResponseOk();
    }
    /**
     * GET /products/{id}
     */
    public  function  testShow()
    {
        $product = Product::all()->random();
        $this->json("get", "/products/{$product->id}");
        $this->assertResponseOk();
    }
    /**
     * POST /products
     */
    public function testCreate()
    {
        $newProduct = factory(Product::class)->raw();
        if(Product::where('name', '=', $newProduct['name'])->first() == null)
        {
            $this->json("post", "/products", $newProduct);
            $this->assertResponseOk();
            $this->seeInDatabase("products", $newProduct);
        }
        else
        {
            $this->json("post", "/products", $newProduct);
            $this->assertResponseStatus(422);
        }
    }
    /**
     * PUT /products/{id}
     */
    public function testUpdate()
    {
        $update = factory(Product::class)->raw();
        $product = Product::all()->random();
        if(Product::where('name', '=', $update['name'])->first() == null or $product->name == $update['name'])
        {
            $this->json("put", "/products/{$product->id}", $update);
            $this->assertResponseOk();
            $this->seeInDatabase("products", $update);
        }
        else
        {
            $this->json("put", "/products/{$product->id}", $update);
            $this->assertResponseStatus(422);
        }

    }
    /**
     * DELETE /products/{id}
     */
    public function testDelete()
    {
        $product = Product::all()->random();
        $this->json("delete", "/products/{$product->id}");
        $this->assertResponseOk();
        $this->notSeeInDatabase("products", $product->toArray());
    }
}

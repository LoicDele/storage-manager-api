<?php

use App\Product;
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
        $this->json("get", "/products/1");
        $this->assertResponseOk();
        $this->json("get", "/products/100");
        $this->assertResponseStatus(404);
    }
}

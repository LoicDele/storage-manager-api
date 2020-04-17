<?php

use App\ProductCategory;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsCategoriesTest extends TestCase
{
    /**
     * GET /productCategories
     */
    public function testIndex()
    {
        $this->json("get", "/productCategories");
        $this->assertResponseOk();
    }
    /**
     * GET /productCategories/{id}
     */
    public  function  testShow()
    {
        $productCategory = ProductCategory::all()->random();
        $this->json("get", "/productCategories/{$productCategory->id}");
        $this->assertResponseOk();
    }
    /**
     * POST /productCategories
     */
    public function testCreate()
    {
        $newProductCategory = factory(ProductCategory::class)->raw();
        $this->json("post", "/productCategories", $newProductCategory);
        $this->assertResponseOk();
        $this->seeInDatabase("product_categories", $newProductCategory);
    }
    /**
     * PUT /productCategories/{id}
     */
    public function testUpdate()
    {
        $update = factory(ProductCategory::class)->raw();
        $productCategory = ProductCategory::all()->random();
        $this->json("put", "/productCategories/{$productCategory->id}", $update);
        $this->assertResponseOk();
        $this->seeInDatabase("product_categories", $update);
    }
    /**
     * DELETE /productCategories/{id}
     */
    public function testDelete()
    {
        $product = ProductCategory::all()->random();
        $this->json("delete", "/productCategories/{$product->id}");
        $this->assertResponseOk();
        $this->notSeeInDatabase("product_categories", $product->toArray());
    }
}

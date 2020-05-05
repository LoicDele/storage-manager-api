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
        $newProductCategory = factory(ProductCategory::class)->create();
        if(ProductCategory::where('name', '=', $newProductCategory->name)->get() == null)
        {
            $this->json("post", "/productCategories", $newProductCategory->toArray());
            $this->assertResponseOk();
            $this->seeInDatabase("product_categories", $newProductCategory->toArray());
        }
        else
        {
            $this->json("post", "/productCategories", $newProductCategory->toArray());
            $this->assertResponseStatus(422);
        }

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

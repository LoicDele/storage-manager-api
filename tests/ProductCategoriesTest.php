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
        if(ProductCategory::where('name', '=', $newProductCategory->name)->first() == null)
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
        $update = factory(ProductCategory::class)->create();
        $productCategory = ProductCategory::all()->random();
        if(ProductCategory::where('name', '=', $productCategory->name)->first() == null or $update->name == $productCategory->name)
        {
            $this->json("put", "/productCategories/{$productCategory->id}", $update->toArray());
            $this->assertResponseOk();
            $this->seeInDatabase("product_categories", $update);
        }
        else
        {
            $this->json("put", "/productCategories/{$productCategory->id}", $update->toArray());
            $this->assertResponseStatus(422);
        }

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

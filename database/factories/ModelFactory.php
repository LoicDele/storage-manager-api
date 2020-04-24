<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;
use App\ProductCategory;
use App\Supplier;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'salePrice' => $faker->biasedNumberBetween(1,100),
        'purchasePrice' => $faker->biasedNumberBetween(1, 100),
        'description' => $faker->text(),
        'category_id' => ProductCategory::all()->random()->id,
        'supplier_id' => Supplier::all()->random()->id,
    ];
});

$factory->define(ProductCategory::class, function (Faker $faker) {
   return ['name' => $faker->word];
});

$factory->define(\App\Supplier::class, function (Faker $faker) {
   return [
       'name' => $faker->company,
       'phoneNumber' => $faker->phoneNumber,
       'address' => $faker->address,
       'mail' => $faker->email,
   ];
});

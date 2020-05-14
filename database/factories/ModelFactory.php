<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\PaymentType;
use Illuminate\Support\Facades\Hash;
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

$factory->define(Supplier::class, function (Faker $faker) {
   return [
       'name' => $faker->company,
       'phoneNumber' => $faker->phoneNumber,
       'address' => $faker->address,
       'mail' => $faker->email,
   ];
});

$factory->define(PaymentType::class, function (Faker $faker) {
   return [
     'name' => $faker->word,
   ];
});

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'product_id' => Product::all()->random()->id,
        'price' => $faker->biasedNumberBetween(1, 100),
        'paymentType_id' => PaymentType::all()->random()->id,
        'number' => $faker->biasedNumberBetween(1,100),
    ];
});

$factory->define(User::class, function (Faker $faker) {
   return [
      'name' => $faker->name,
      'email' => $faker->email,
      'password' => '1234',
   ] ;
});

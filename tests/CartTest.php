<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

use Faker\Factory;
use frankyso\iPaymu\iPaymu;
use frankyso\iPaymu\Product;
use PHPUnit\Framework\TestCase;

/**
 * @author Franky So <frankyso.mail@gmail.com>
 */
final class CartTest extends TestCase
{
    public function testAddProductToCart()
    {
        $faker = Factory::create();
        $iPaymu = new iPaymu($_SERVER['APP_KEY']);

        for ($x = 0; $x <= 10; $x++) {
            $product = new Product();
            $product->id = $faker->uuid;
            $product->name = $faker->name;
            $product->price = rand(10000, 1000000);
            $product->quantity = rand(1, 5);

            $iPaymu->cart()->add($product);
        }
    }

    public function testRemoveProductFromCart()
    {
        $faker = Factory::create();
        $iPaymu = new iPaymu($_SERVER['APP_KEY']);

        for ($x = 0; $x <= 10; $x++) {
            $product = new Product();
            $product->id = $faker->uuid;
            $product->name = $faker->name;
            $product->price = rand(10000, 1000000);
            $product->quantity = rand(1, 5);

            $iPaymu->cart()->add($product);
            $iPaymu->cart()->remove($product->id);
        }
    }

    public function testCheckout()
    {
        $faker = Factory::create();
        $iPaymu = new iPaymu($_SERVER['APP_KEY']);

        for ($x = 0; $x <= 3; $x++) {
            $product = new Product();
            $product->id = $faker->uuid;
            $product->name = $faker->name;
            $product->price = rand(10000, 1000000);
            $product->quantity = rand(1, 5);

            $iPaymu->cart()->add($product);
        }

        $response = $iPaymu->cart()->checkout("no comment");
        $this->assertArrayHasKey('url', $response);
    }
}
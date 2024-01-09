<?php

namespace App\Models;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Random\RandomException;

class OrderFactory
{
    /**
     * @throws BindingResolutionException
     * @throws RandomException
     */
    public function make() : Order
    {
        $faker = app()->make(Faker::class);
        $order = new Order();
        $order->delivery_by = $faker->dateTime;
        $order->deliver_to = Order::$tos[random_int(0, 2)];
        $order->reference = Str::random(15);
        return $order;
    }
}

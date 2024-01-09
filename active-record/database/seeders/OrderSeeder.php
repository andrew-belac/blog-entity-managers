<?php

namespace Database\Seeders;

use App\Models\OrderFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws BindingResolutionException|\Random\RandomException
     */
    public function run(): void
    {
        /** @var OrderFactory $factory */
        $factory = app()->make(OrderFactory::class);
        $i = 0;
        while ($i < 1000){
            $i++;
            $order = $factory->make();
            $order->save();
            unset($order);
        }
    }
}

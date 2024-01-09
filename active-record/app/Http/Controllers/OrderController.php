<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderFactory;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function byReference(Request $request) : JsonResponse
    {
        $order1 = Order::query()->findOrFail(1);
        $order2 = Order::query()->where('reference', $order1->reference)->firstOrFail();
        return response()->json([
            'order1'=>spl_object_id($order1),
            'order2'=>spl_object_id($order2)]);
    }

    public function saveTwice(Request $request) : JsonResponse
    {
        DB::transaction(function(){
            $order = Order::query()->findOrFail(1);
            $order->deliver_to = Order::$tos[random_int(0, 2)];
            $order->saveOrFail();
            $order->delivery_by = CarbonImmutable::now();
            $order->saveOrFail();
        });
        return response()->json();
    }

    public function fetchTwice(Request $request) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $order1 = Order::query()->findOrFail(1);
            $order2 = Order::query()->findOrFail(1);
            DB::commit();
        } catch (\Throwable $e){
            DB::rollBack();
        }
        return response()->json([
            'order1'=>spl_object_id($order1),
            'order2'=>spl_object_id($order2)]);
    }
}

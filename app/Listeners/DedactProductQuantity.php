<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DedactProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $order = $event->order;
        foreach ($order->products as $product) {
            // dd($product);
            // exit;
            $product->decrement('quantity', $product->order_item->quantity);
        }
    }
}
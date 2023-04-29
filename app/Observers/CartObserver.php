<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Str;

class CartObserver
{
    
    public function created(Cart $cart)
    {
        $cart->id=Str::uuid();
    }

    
    public function updated(Cart $cart)
    {
        //
    }

   
    public function deleted(Cart $cart)
    {
        //
    }

   
    public function restored(Cart $cart)
    {
        //
    }

   
    public function forceDeleted(Cart $cart)
    {
        //
    }
}
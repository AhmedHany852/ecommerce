<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    public function get(): Collection
    {
        return Cart::with('product')
            ->where('cookie_id',  $this->getCookiId())->get();
    }
    public function add(Product $product, $quantity = 1)
    {
        $item =  Cart::where('product_id',  $product->id)
            ->where('cookie_id',  $this->getCookiId())
            ->first();
        if (!$item) {
            return Cart::create([
                'cookie_id' =>  $this->getCookiId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,

            ]);
        }
        return $item->increment('quantity', $quantity);
    }
    public function update($id, $quantity)
    {
        Cart::where('product_id',  $id)
            ->where('cookie_id', $this->getCookiId())
            ->update([
                'quantity' => $quantity,
            ]);
    }
    public function delete($id)
    {
        Cart::where('id',  $id)
            ->where('cookie_id',   $this->getCookiId())
            ->delete();
    }
    public function empty()
    {
        // Cart::query()->where('cookie_id',   $this->getCookiId())->delete();
        Cart::query()->delete();
    }
    public function total(): float
    {
        return (float) Cart::where('cookie_id',   $this->getCookiId())->join('products', 'products.id',  'carts.product_id')->selectRaw('Sum(products.price*carts.quantity) as total')->value('total');
    }
    public function getCookiId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30);
        }
        return $cookie_id;
    }
}
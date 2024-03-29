<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Cart;
use App\Repositories\Cart\CartRepository;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $items;
    public $total;

    public function __construct(CartRepository $cart)
    {
        $this->items = $cart->get();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
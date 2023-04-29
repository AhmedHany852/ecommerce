<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepository  $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {


        return view('front.cart', [
            'cart' => $this->cart
        ]);
    }


    public function store(Request $request, CartRepository $cart)
    {
        // print_r($request->all());
        // exit;
        $request->validate([
            // 'product_id' => ['required', 'int'],
            'quantity' => ['required', 'int', 'min:1'],
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity'));
        if ($request->expectsJson()) {
            return response()->json([
                'massage' => 'Item Add Cart'
            ]);
        }
        return redirect()->route('cart.index')
            ->with('success', 'product add to cart');
    }



    public function update(Request $request, $id)
    {

        $request->validate([
            // 'product_id' => ['required', 'int'],
            'quantity' => ['required', 'int', 'min:1'],
        ]);
        // $product = Product::findOrFail($request->post('product_id'));
        $this->cart->update($id, $request->post('quantity'));
        return ['ok'];
    }


    public function destroy($id)
    {

        $this->cart->delete($id);
        return ['ok delete'];
    }
}
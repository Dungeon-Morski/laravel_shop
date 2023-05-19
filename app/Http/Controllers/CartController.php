<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {

        $cart = Cart::with('user', 'product')->where('user_id', '=', Auth::user()->id)->get();

        return view('user.cart', compact('cart'));
    }

    public function edit(Request $request, Cart $cart, Product $product)
    {

        if ($request->value == 'increment') {

            $added = Cart::add($cart->product_id);

            if ($added != true) {
                return response()->json(['status' => 200, 'message' => 'Лимит товара в наличии']);
            }

        }

        if ($request->value == 'decrement') {

            $remove = Cart::remove($cart->product_id);

        }
        return response()->json(['status' => 200, 'count' => $cart->quantity, 'product_quantity' => $cart->product->quantity, 'product_price' => $cart->product->price]);
    }


}

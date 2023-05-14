<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->latest()->get();

        return view('product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $count = Product::findOrFail($product->id);
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get('quantity');


        $added = Cart::add($product->id);
        return response()->json([
            'status' => 200,
            'count' => $count->quantity,
            'inCart' => $cart,
            'added' => $added
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\ProductFilterRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(ProductFilterRequest $request)
    {

        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->with('category')->where('quantity', '>', 0)->latest()->paginate(8);

        $categories = ProductCategory::all();
        $countries = Product::distinct()->pluck('country');

        return view('product.index', compact('products', 'categories', 'countries'));
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

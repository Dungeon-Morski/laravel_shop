<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AboutController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(5)->get();

        return view('about', compact('products'));
    }
}

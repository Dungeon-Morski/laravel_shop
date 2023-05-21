<?php

namespace App\Http\Controllers\Admin;


use App\Http\Filters\OrderFilter;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\ProductFilterRequest;
use App\Http\Requests\Order\OrderFilterRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    //products function
    public function products(ProductFilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $countries = Product::distinct()->pluck('country');
        $categories = ProductCategory::all();
        $products = Product::filter($filter)->with('category')->latest()->paginate(6);

        return view('admin.products', compact('products', 'categories', 'countries'));
    }

    public function productDestroy(Request $request, Product $product)
    {
        $product->delete();
        return back();
    }

    public function productCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'price' => 'integer|required',
            'category_id' => 'integer|required',
            'image' => 'file|required',
            'quantity' => 'integer|required',
            'country' => 'string|required',
            'color' => 'string|required',
        ]);

        if (isset($data['image'])) {
            $data['image'] = Storage::putFileAs(
                'public', $data['image'], Str::random(40) . "." . $data['image']->extension()
            );
            $data['image'] = mb_substr($data['image'], 7, 99);
        }
        Product::create($data);
        return back();
    }

    public function productShow(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.productShow', compact('product', 'categories'));
    }

    public function productEdit(Request $request, Product $product)
    {

        $data = $request->validate([
            'title' => 'string|nullable',
            'description' => 'string|nullable',
            'price' => 'integer|nullable',
            'category_id' => 'integer|nullable',
            'image' => 'file|nullable',
            'quantity' => 'integer|nullable',
            'country' => 'string|nullable',
            'color' => 'string|nullable',
        ]);

        if (isset($data['image'])) {
            $data['image'] = Storage::putFileAs(
                'public', $data['image'], Str::random(40) . "." . $data['image']->extension()
            );
            $data['image'] = mb_substr($data['image'], 7, 99);

        }
        $product->update($data);

        return back();
    }

    //category function
    public function categories()
    {
        $categories = ProductCategory::all();

        return view('admin.categories', compact('categories'));
    }

    public function categoryShow(Request $request, ProductCategory $category)
    {

        return view('admin.categoryShow', compact('category'));
    }

    public function categoryEdit(Request $request, ProductCategory $category)
    {
        $data = $request->validate([
            'title' => 'string|nullable',

        ]);
        $category->update($data);
        return redirect()->route('admin.categories');
    }

    public function categoryCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',

        ]);
        ProductCategory::create($data);
        return back();

    }

    public function categoryDestroy(Request $request, ProductCategory $category)
    {
        $categoryUsed = Product::where('category_id', $category->id)->first();

        if (empty($categoryUsed)) {
            $category->delete();
        } else {
            dd('Категория используется в товаре');
        }

        return back();
    }

    //orders function
    public function orders(OrderFilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(OrderFilter::class, ['queryParams' => array_filter($data)]);

        $orders = Order::filter($filter)->withCount('orderProduct', 'user')->latest()->paginate(1);


        return view('admin.orders', compact('orders'));
    }

    public function orderEdit(Request $request, Order $order)
    {

        $data = $request->validate([
            'status' => 'string|required',
            'result' => 'string|required',
        ]);
        $order->update([
            'status' => $data['status'],
            'result' => $data['result'],
        ]);
        return back();
    }
}

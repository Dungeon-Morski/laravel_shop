<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::withCount('orderProduct')->where('user_id', Auth::user()->id)->paginate(1);

        return view('user.order', compact('orders'));

    }

    public function destroy(Request $request, Order $order)
    {


        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        foreach ($orderProducts as $orderProduct) {
            $product = Product::where('id', $orderProduct->product_id)->first();
            $product->quantity += $orderProduct->quantity;
            $product->save();
            $orderProduct->delete();
        }

        $order->delete();
        return back();
    }
}

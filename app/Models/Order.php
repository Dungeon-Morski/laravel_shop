<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $guarded = false;


    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function orderCheckout($user_id)
    {

        $carts = Cart::with('product', 'user')->where('user_id', Auth::user()->id)->get();


        $order = self::create([
            'name' => Auth::user()->login,
            'user_id' => Auth::user()->id,
            'result' => '',
            'status' => 'Новый',
        ]);


        foreach ($carts as $cart) {
            OrderProduct::create([
                'name' => Auth::user()->login,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);

            $product = Product::findOrFail($cart->product_id);

            $product->quantity -= $cart->quantity;

            $product->save();
            $cart->delete();
        }


        $orderProducts = OrderProduct::with('product')->where('order_id', $order->id)->get();
        $orderPrice = 0;

        foreach ($orderProducts as $orderProduct) {
            $orderPrice += $orderProduct->product->price * $orderProduct->quantity;

        }
        $order->update([
            'price' => $orderPrice
        ]);

        return true;

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class OrderProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
//    public static function add($user_id)
//    {
//
//        if ($cart = Cart::where('user_id', $user_id)->get()) {
//
//            $products = Cart::where('user_id', Auth::user()->id)->get();
//
//            foreach ($cart as $item) {
//                $orderProduct = self::create([
//                    'user_id' => Auth::user()->id,
//                    'product_id' => $item->product_id,
//                    'quantity' => $item->quantity,
//                ]);
//                $item->delete();
//                $products = Product::where('id', $item->product_id)->get();
//                foreach ($products as $product) {
//                    $product->quantity -= $item->quantity;
//                    $product->save();
//                }
//
//            }
//
//
//
//            return true;
//        }
//
//        return true;
//    }
}

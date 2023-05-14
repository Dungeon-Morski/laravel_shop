<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function quantity($id, $quantity)
    {

        $cart = self::findOrFail($id);
        $cart->quantity = $quantity;
        $cart->save();
        return $cart;
    }

    public static function add($product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($cart = self::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first()) {
            if ($product->quantity > $cart->quantity) {
                $cart->quantity++;
                $cart->save();
                return true;
            }
            return false;
        } else {
            $cart = self::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return $cart;
    }

    public static function remove($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($cart = self::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first()) {
            if ($cart->quantity <= 0 || $cart->quantity === 1) {
                $cart->delete();
                return true;
            } else {
                $cart->quantity--;
                $cart->save();
            }
        }
        return $cart;
    }
}

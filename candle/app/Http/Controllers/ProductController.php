<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function fetch()
    {
        $products = Product::all();

        return view('components.Home', compact('products'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('components.Show', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->total = $cartItem->quantity * $product->price;
            $cartItem->save();

        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
            ]);
        }
        return view('components.Show', compact('product', 'cartItem'));
    }
}


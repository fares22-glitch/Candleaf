<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;

use Couchbase\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Session;

class CartController extends Controller
{

    public function increment(Request $request)
    {
        $Q = $request->session()->get('Q', 1);
        $Q++;
        $request->session()->put('Q', $Q);
        return redirect()->back();
    }

    public function decrement(Request $request)
    {
        $Q = $request->session()->get('Q', 1);
        if ($Q > 1) {
            $Q--;
            $request->session()->put('Q', $Q);
        }
        return redirect()->back();
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $userId = auth()->user()->id;

        $product = Product::findOrFail($productId);

        $total = $product->price * $quantity;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->total = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'total' => $total
            ]);
        }

        return redirect()->back();
    }

    public function showCart()
    {
        $cartItems = Cart::with('product')
        ->where('user_id', auth()->id())
            ->get();
        session(['shipcart' => $cartItems]);
        return view('components.Cart',['cartItems' => $cartItems]);
    }


    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back();
    }

    public function showDetails()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
        session(['shipcart' => $cartItems]);
        $subtotal = $cartItems->sum('total');

        return view('components.Authentication', compact('cartItems', 'subtotal'));
    }

}

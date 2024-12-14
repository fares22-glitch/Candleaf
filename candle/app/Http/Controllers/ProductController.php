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
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function save(Request $request)
    {
        session(['selected' => 1]);
        session(['shipping_method' => $request->input('shipping')]);
        return view('components.Shipping');
    }

}

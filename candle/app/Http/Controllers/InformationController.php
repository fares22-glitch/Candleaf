<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ]);

        $existingInformation = Information::where('user_id', auth()->id())
            ->first();

        if ($existingInformation) {
            $existingInformation->update([
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'save_for_checkout' => $request->has('save_for_checkout'),
            ]);
        } else {
            Information::create([
                'user_id' => auth()->id(),
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'save_for_checkout' => $request->has('save_for_checkout'),
            ]);
        }
        $existingInformation = Information::where('user_id', auth()->id())
            ->first();
        session(['existingInformation' => $existingInformation]);

        return view('components.Shipping');
    }

}

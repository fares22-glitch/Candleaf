<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

        if ($coupon) {
            $coupon->increment('usage_count');
            $discount = $coupon->discount;

            session()->put('coupon_code', $coupon->coupon_code);
            session()->put('discount', $discount);

            return redirect()->back()->with('success', 'Coupon applied successfully!');
        }
        else {
            session()->put('coupon_code', null);
            return redirect()->back()->with('error', 'Invalid coupon code!');
        }
    }
}

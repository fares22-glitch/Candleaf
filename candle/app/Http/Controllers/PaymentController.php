<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'card_number' => 'required|numeric|digits_between:13,19',
            'holder_name' => 'required|string|min:3|max:50',
            'expiration' => 'required|date_format:m/y|after_or_equal:' . now()->format('m/y'),
            'cvv' => 'required|numeric|digits_between:3,4',
        ];
        $messages = [
            'card_number.required' => 'The card number is required.',
            'card_number.numeric' => 'The card number must be a valid numeric value.',
            'card_number.digits_between' => 'The card number must be between 13 and 19 digits.',
            'holder_name.required' => 'The cardholder name is required.',
            'holder_name.min' => 'The cardholder name must be at least 3 characters.',
            'holder_name.max' => 'The cardholder name must not exceed 50 characters.',
            'expiration.required' => 'The expiration date is required.',
            'expiration.date_format' => 'The expiration date must be in MM/YY format.',
            'expiration.after_or_equal' => 'The expiration date must not be in the past.',
            'cvv.required' => 'The CVV is required.',
            'cvv.numeric' => 'The CVV must be a valid numeric value.',
            'cvv.digits_between' => 'The CVV must be either 3 or 4 digits.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('pay.show')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed. Please check the highlighted fields and try again.');
        }

        $creditCard = CreditCard::where('card_number', $request->card_number)
            ->where('holder_name', $request->holder_name)
            ->where('expiration', $request->expiration)
            ->where('cvv', $request->cvv)
            ->first();

        if ($creditCard) {
            return view('components.Message');
        } else {
            return redirect()->route('pay.show')->with('error', 'Payment failed. Card details are invalid.');
        }
    }
    public function receipt()
    {
        session(['receipt'=>1]);
        return view('components.Message');
    }
    public function delcart()
    {
        Cart::where('user_id', auth()->id())->delete();
        session(['cartCount' => 0]);
        session(['shipcart' => []]);
        return redirect()->route('product.fetch');
    }

}

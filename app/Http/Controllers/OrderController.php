<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use ErrorException;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    private array $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart', []);
    }

    /**
     * Pay order by stripe
     */
    public function payOrderByStripe() : RedirectResponse | string
    {
        //provide the stripe key
        Stripe::setApiKey(config('services.stripe.secret'));
        //proceed to payment
        try {
            $checkout_session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Fashion Store'
                        ],
                        'unit_amount' => $this->calculateTotalToPay($this->cart),
                    ],
                    'quantity' => 1
                ]],
                'mode' => 'payment',
                'success_url' => route('order.success', ['session_id' => '{CHECKOUT_SESSION_ID}'])
            ]);
            return redirect($checkout_session->url);
        } catch (ErrorException $e) {
            Log::error('Stripe error: '.$e->getMessage());
            return back()->with('error', 'Something went wrong with the payment. Please try again.');
        }
    }
    
    /**
     * Calculate the total to pay
     */
    private function calculateTotalToPay(array $items) : float
    {
        $total = 0;
        foreach($items as $item)
        {
            $total += $this->calculateEachOrderTotal($item['qty'],$item['price'],$item['coupon_id']);
        }
        return $total * 100;
    }

    /**
     * Calculate the total of each order
     */
    private function calculateEachOrderTotal(int $qty, int $price, ?int $coupon_id = null) : float
    {
        $discount = 0;
        $total = $price * $qty;
        $coupon = Coupon::find($coupon_id);
        //check if the coupon is still valid
        if($coupon && !$coupon->checkIfExpired()) {
            $discount = $total * $coupon->discount / 100;
        }
        //return the total of each order
        return $total - $discount;
    }

    /**
     * Store orders after success payment
     */
    public function successPaid(Request $request) : View | RedirectResponse
    {
        $sessionId = $request->get('session_id');
        if($sessionId) {
            //store the orders
            foreach($this->cart as $key => $item) {
               $order = Order::create([
                    'size' => $item['size'],
                    'color' => $item['color'],
                    'qty' => $item['qty'],
                    'user_id' => auth()->user()->id,
                    'coupon_id' => $item['coupon_id'],
                    'total' => $this->calculateEachOrderTotal($item['qty'],$item['price'],$item['coupon_id']),
               ]);
               $order->products()->attach((int) explode('-', $key)[0]);
            }
            session()->forget('cart');
            session()->forget('cartItemsTotal');
            session()->forget('applied_coupon');
            return view('payments.success-paid');
        }else {
            return to_route('home');
        }
    }
}

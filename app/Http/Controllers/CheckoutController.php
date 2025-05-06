<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    private array $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart', []);
    }

    /**
     * Get the cart items from the session
     *
     * @return View
     */
    public function index() : View
    {
        $cart = $this->cart;
        //get cart items from the session
        return view('checkout.index',compact('cart'));
    }

    /**
     * Apply the coupon
     */
    public function applyCoupon(Request $request) : RedirectResponse
    {
        //validate the data
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        //find the coupon by name
        $coupon = Coupon::where('name', $request->name)->first();
        //if coupon does not exist
        if(!$coupon) {
            return back()->with('error','The coupon is invalid');
        }
        //if coupon has expired
        if($coupon->checkIfExpired()) {
            return back()->with('error','The coupon has expired');
        }
        //add the coupon to the cart items
        $this->assignCouponToCartItems($coupon->id);
        //update the cart in the session
        session()->put('cart', $this->cart);
        //store the applied coupon in the session
        session()->put('applied_coupon', $coupon);
        return back()->with('success','The coupon applied successfully');
    }

    /**
     * Remove coupon from session
     */
    public function removeCoupon() : RedirectResponse
    {
        //set coupon id to null inside the cart 
        $this->assignCouponToCartItems(null);
        //update the cart in the session
        session()->put('cart', $this->cart);
        session()->forget('applied_coupon');
        return back()->with('info','The coupon removed successfully');
    }

    /**
     * Assign the coupon id to the cart items
     */
    public function assignCouponToCartItems(?int $couponId = null) : void
    {
        foreach(array_keys($this->cart) as $key) {
            $this->cart[$key]['coupon_id'] = $couponId;
        }
    }
}

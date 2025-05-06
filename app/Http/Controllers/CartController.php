<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
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
        return view('cart.index',compact('cart'));
    }

    /**
     * Add items to the cart
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addToCart(Request $request) : RedirectResponse
    {
        if($request->has(['size','color'])) {
            //find and get the product by id
            $product = Product::findOrFail($request->product_id);
            //generate a unique key for each cart item
            $key = $this->generateCartKey($product->id, $request->color, $request->size);
            //check if the product is already in the cart
            if(isset($this->cart[$key])) {
                return back()->with('info', 'Product already added to your cart');
            }else {
                $this->cart[$key] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'maxQty' => $product->qty,
                    'qty' => $request->qty,
                    'image' => $product->thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    'coupon_id' => session()->has('applied_coupon') ? session()->get('applied_coupon')->id : null
                ];

                session()->put('cart', $this->cart);
                $this->calculateCartItemsTotal();

                return back()->with('success', 'Product added to your cart');
            }
        }else {
            return back()->with('error', 'Please choose a color and a size');
        }
    }

    /**
     * Update item inside the cart
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateCartItem(Request $request) : RedirectResponse
    {
        //find and get the product by id
        $product = Product::findOrFail($request->product_id);
        //generate a unique key for cart item
        $key = $this->generateCartKey($product->id, $request->color, $request->size);
        //get the new qty
        $qty = $request->qty;
        //check if the product is already in the cart
        if(isset($this->cart[$key])) {
            $this->cart[$key]['qty'] = $qty;
            //set the new cart session
            session()->put('cart', $this->cart);
            $this->calculateCartItemsTotal();
        }
        return back()->with('success', 'Cart updated successfully');
    }

    /**
     * Remove item from the cart
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeCartItem(Request $request) : RedirectResponse
    {
        //find and get the product by id
        $product = Product::findOrFail($request->product_id);
        //generate a unique key for cart item
        $key = $this->generateCartKey($product->id, $request->color, $request->size);
        //check if the product is already in the cart
        if(isset($this->cart[$key])) {
            unset($this->cart[$key]);
            //set the new cart session
            session()->put('cart', $this->cart);
            $this->calculateCartItemsTotal();
        }

        if(empty($this->cart)) {
            session()->forget('applied_coupon');
        }

        return back()->with('success', 'Product removed successfully');
    }

    /**
     * Clear the cart
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function clearCart() : RedirectResponse
    {
        //remove cart from the session
        session()->forget('cart');
        session()->forget('cartItemsTotal');
        session()->forget('applied_coupon');
        return back()->with('success', 'Cart cleared');
    }

    private function calculateCartItemsTotal() : void
    {
        $total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
        session()->put('cartItemsTotal', $total);
    }

    private function generateCartKey(int $productId, string $color, string $size) : string
    {
        return $productId .'-'. $color .'-'. $size;
    }
}

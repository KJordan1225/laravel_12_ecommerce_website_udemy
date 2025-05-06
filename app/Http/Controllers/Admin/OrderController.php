<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Update the orders delivered at date
     */
    public function updateDeliveredAtDate(Order $order) : RedirectResponse
    {
        $order->update([
            'delivered_at' => now()
        ]);
        return to_route('admin.orders.index')->with('success','Order marked as delivered');
    }

    /**
     * Delete orders
     */
    public function destroy(Order $order) : RedirectResponse
    {
        $order->delete();
        return to_route('admin.orders.index')->with('success','Order deleted successfully');
    }
}

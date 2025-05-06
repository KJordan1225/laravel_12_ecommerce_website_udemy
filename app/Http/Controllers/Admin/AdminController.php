<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Charts\MonthlyOrdersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthAdminRequest;

class AdminController extends Controller
{
    /**
     * Display the customers orders & reviews
     */
    public function index() : View
    {
        $userCount = User::count();
        $orderCount = Order::count();
        $reviewCount = Review::count();

        // Define month labels
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        //set the chart title
        $chartTitle = 'Orders during '.Carbon::now()->year.'.';

        //send the data to the chart
        $chart = (new MonthlyOrdersChart())->build($chartTitle, $this->getMonthlyOrderData(), $months);

        //the chart will display orders by month
        return view('admin.dashboard',compact('userCount', 'orderCount', 'reviewCount', 'chart'));
    }

    /**
     * Display the login form for the admin
     */
    public function login() : View
    {
        return view('admin.login');
    }

    /**
     * Log in the admin
     */
    public function auth(AuthAdminRequest $request) : RedirectResponse
    {
        if(auth()->guard('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            return to_route('admin.index');
        }else {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.'
            ])->onlyInput('email');
        }
    }

    /**
     * Log out the admin
     */
    public function logout(Request $request) : RedirectResponse
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('admin.login');
    }

    /**
     * Calculate the number of orders for each month
     *
     * @return array
     */
    private function getMonthlyOrderData(): array
    {
        // First we get all the orders and we group them by month
        // Next using map and count we get the count of orders for each month
        $monthlyOrdersCount = Order::all()->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->format('n'); 
            // Get month as number (1-12)
        })->map->count();

        // start_index = 0 → Start filling from index 0.
        // count = 12 → Create 12 elements.
        // value = 0 →  Each element is initialized to 0.
        // example [0,0,0,0,0,0,0,0,0,0,0,0]
        $ordersByMonthArray = array_fill(0, 12, 0);

        //array_fill(0, 12, 0) initializes $ordersByMonthArray with 12 zeros (for all months).
        //$month - 1 ensures that January (1) is at index 0, February (2) at index 1, and so on.
        //$ordersByMonthArray[$month - 1] = $count; places the order count ($count) in the correct index.

        foreach ($monthlyOrdersCount as $month => $count) {
            $ordersByMonthArray[$month - 1] = $count;
        }

        return $ordersByMonthArray;
    }
}

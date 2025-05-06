<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCouponRequest $request) : RedirectResponse
    {
        Coupon::create($request->validated());
        return to_route('admin.coupons.index')->with('success','Coupon added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon) : void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon) : View
    {
        return view('admin.coupons.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon) : RedirectResponse
    {
        $coupon->update($request->validated());
        return to_route('admin.coupons.index')->with('success','Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon) : RedirectResponse
    {
        $coupon->delete();
        return to_route('admin.coupons.index')->with('success','Coupon deleted successfully');
    }
}

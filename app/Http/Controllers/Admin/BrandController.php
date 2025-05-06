<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBrandRequest $request) : RedirectResponse
    {
        Brand::create($request->validated());
        return to_route('admin.brands.index')->with('success','Brand added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand) : void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand) : View
    {
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand) : RedirectResponse
    {
        $brand->update($request->validated());
        return to_route('admin.brands.index')->with('success','Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand) : RedirectResponse
    {
        $brand->delete();
        return to_route('admin.brands.index')->with('success','Brand deleted successfully');
    }
}

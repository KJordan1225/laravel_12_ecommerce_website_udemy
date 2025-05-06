<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AddSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use Illuminate\View\View;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $subcategories = Subcategory::all();
        return view('admin.subcategories.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = Category::all();
        return view('admin.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSubcategoryRequest $request) : RedirectResponse
    {
        Subcategory::create($request->validated());
        return to_route('admin.subcategories.index')->with('success','Subcategory added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory) : void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory) : View
    {
        $categories = Category::all();
        return view('admin.subcategories.edit',compact('categories','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory) : RedirectResponse
    {
        $subcategory->update($request->validated());
        return to_route('admin.subcategories.index')->with('success','Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory) : RedirectResponse
    {
        $subcategory->delete();
        return to_route('admin.subcategories.index')->with('success','Subcategory deleted successfully');
    }
}

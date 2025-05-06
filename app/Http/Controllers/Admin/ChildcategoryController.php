<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddChildcategoryRequest;
use App\Http\Requests\UpdateChildcategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChildcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $childcategories = Childcategory::all();
        return view('admin.childcategories.index',compact('childcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $subcategories = Subcategory::all();
        return view('admin.childcategories.create',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddChildcategoryRequest $request) : RedirectResponse
    {
        Childcategory::create($request->validated());
        return to_route('admin.childcategories.index')->with('success','Child category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Childcategory $childcategory) : void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Childcategory $childcategory) : View
    {
        $subcategories = Subcategory::all();
        return view('admin.childcategories.edit',compact('subcategories','childcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildcategoryRequest $request, Childcategory $childcategory) : RedirectResponse
    {
        $childcategory->update($request->validated());
        return to_route('admin.childcategories.index')->with('success','Child category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Childcategory $childcategory) : RedirectResponse
    {
        $childcategory->delete();
        return to_route('admin.childcategories.index')->with('success','Child category deleted successfully');
    }
}

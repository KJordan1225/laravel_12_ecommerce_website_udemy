<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSizeRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateSizeRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $sizes = Size::all();
        return view('admin.sizes.index',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSizeRequest $request) : RedirectResponse
    {
        Size::create($request->validated());
        return to_route('admin.sizes.index')->with('success','Size added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size) : void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size) : View
    {
        return view('admin.sizes.edit',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size) : RedirectResponse
    {
        $size->update($request->validated());
        return to_route('admin.sizes.index')->with('success','Size updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size) : RedirectResponse
    {
        $size->delete();
        return to_route('admin.sizes.index')->with('success','Size deleted successfully');
    }
}

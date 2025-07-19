<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    private array $imageFields = ['thumbnail','first_image','second_image','third_image'];
    

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $products = Product::all()->withRelationshipAutoloading();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.products.create')->with($this->getProductFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        //check if the admin sent all the images
        foreach($this->imageFields as $field) {
            if($request->hasFile($field)) {
                //save product images
                $data[$field] = $this->saveImage($request->file($field));
            }
        }
        //calculate the discount
        if($request->old_price > 0 && $request->old_price > $request->price) {
            $data['old_price'] = $request->old_price;
            $data['discount'] = round((($request->old_price - $request->price) / $request->old_price) * 100);
        }
        //store the product
        $product = Product::create($data);
        //add product colors
        $product->colors()->sync($request->color_id);
        //add product sizes
        $product->sizes()->sync($request->size_id);
        //redirect the admin to the product's index page
        return to_route('admin.products.index')->with('success','Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) : void
    { 
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product) : View
    {
        return view('admin.products.edit')->with(array_merge($this->getProductFormData(), ['product' => $product]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
    {
        $data = $request->validated();
        //check if the admin sent all the images
        foreach($this->imageFields as $field) {
            if($request->hasFile($field)) {
                //remove product old images
                $this->removeProductImageFromStorage($product->$field);
                //save product new images
                $data[$field] = $this->saveImage($request->file($field));
            }
        }
        //calculate the discount
        if($request->old_price > 0 && $request->old_price > $request->price) {
            $data['old_price'] = $request->old_price;
            $data['discount'] = round((($request->old_price - $request->price) / $request->old_price) * 100);
        }
        //change the status of the product
        $data['status'] = $request->status;
        //update the product
        $product->update($data);
        //add product colors
        $product->colors()->sync($request->color_id);
        //add product sizes
        $product->sizes()->sync($request->size_id);
        //redirect the admin to the product's index page
        return to_route('admin.products.index')->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) : RedirectResponse
    {
        //remove product images
        foreach($this->imageFields as $field) {
            $this->removeProductImageFromStorage($product->$field);
        }
        //delete the product
        $product->delete();
        //redirect the admin to the product's index page
        return to_route('admin.products.index')->with('success','Product deleted successfully.');
    }

    /**
     * Save the product images
     */
    public function saveImage($file) : string
    {
        $image_name = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('images/products',$image_name,'public');
        //return a link to the image https://your-domain-url/storage/images/name.jpg
        return Storage::url($path);
    }

    /**
     * Remove the product images from storage
     */
    public function removeProductImageFromStorage($file) : void
    {
        $path = str_replace('/storage/','',$file);
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }   
    }

    private function getProductFormData() : array
    {
        return [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'childcategories' => Childcategory::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'brands' => Brand::all(),
        ];
    }
}

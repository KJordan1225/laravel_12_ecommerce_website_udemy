<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Get product by slug
     */
    public function show(Product $product) : View
    {
        //return the view
        return view('products.show',compact('product'));
    }

    /**
     * Get all the products
     */
    public function index(Request $request) : View
    {
        //get the per page value from the url
        //set the default to 5 
        $perPage = $request->input('per_page', 4);
        //get products paginated
        $products = Product::paginate($perPage);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Get products ordered by name,price,date
     */
    public function orderProducts(Request $request) : View | RedirectResponse
    {
        if($request->input('field')) {
            //get the field and check if exists 
            $allowedFields = ['name','price','date'];
            $field = in_array($request->input('field'),$allowedFields) ? $request->input('field') : 'name';
            //get the direction and check if exists 
            $allowedDirections = ['asc','desc'];
            $direction = in_array($request->input('direction'),$allowedDirections) ? $request->input('direction') : 'asc';
            //get products ordered by field and direction
            $products = Product::orderBy($field,$direction)->paginate(4);
            //return the view
            return view('home',compact('products'));
        }else {
            return to_route('home')->with('error','Please choose a field to order by');
        }
    }

    /**
     * Get all products by subcategory
     */
    public function productsBySubcategory(Subcategory $subcategory) : View
    {
        //get products by subcategory
        $products = $subcategory->products()->paginate(4);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Get all products by subcategory
     */
    public function productsByChildcategory(Childcategory $childcategory) : View
    {
        //get products by childcategory
        $products = $childcategory->products()->paginate(4);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Get all products by brand
     */
    public function productsByBrand(Brand $brand) : View
    {
        //get products by brand
        $products = $brand->products()->paginate(4);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Get all products by size
     */
    public function productsBySize(Size $size) : View
    {
        //get products by size
        $products = $size->products()->paginate(4);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Get all products by color
     */
    public function productsByColor(Color $color) : View
    {
        //get products by color
        $products = $color->products()->paginate(4);
        //return the view
        return view('home',compact('products'));
    }

    /**
     * Search for products by term
     */
    public function searchProducts(Request $request) : View
    {
        //validate the data
        $validated = $request->validate([
            'searchTerm' => 'required|string|max:255'
        ]);

        //remove tags from the search term
        $query = strip_tags($validated['searchTerm']);

        //get products by search term
        $products = Product::whereAny([
            'name',
            'description'
        ], 'LIKE' , "%$query%")->paginate(4);
        
        //return the view
        return view('home',compact('products'));
    }
}

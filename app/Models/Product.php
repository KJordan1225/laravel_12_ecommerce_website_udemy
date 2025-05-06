<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'description',
        'qty',
        'price',
        'old_price',
        'discount',
        'thumbnail',
        'first_image',
        'second_image',
        'third_image',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'status'
    ];

    /**
     * Set slug automatically
     */
    public function setNameAttribute($value) : void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() : BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function childcategory() : BelongsTo
    {
        return $this->belongsTo(Childcategory::class);
    }

    public function brand() : BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors() : BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes() : BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class)
            ->with('user')
            ->where('approved',1)
            ->latest();
    }

    public function getRouteKeyName() : string
    {
        return "slug";
    }

    // //Auto-load the product relationships whenever a Product is retrieved
    // //instead of using with in the controller u can use automaticallyEagerLoadRelationships() 
    // //this feature was introduced in laravel 12.8
    // protected static function booted(): void
    // {
    //     static::automaticallyEagerLoadRelationships();
    // }

    public function isBoughtByUser($productId)
    {
        return $this->orders()->where([
            'user_id' => auth()->user()->id,
            'product_id' => $productId
        ])->exists();
    }

    public function avgRating()
    {
        return $this->reviews()->avg('rating');
    }
}

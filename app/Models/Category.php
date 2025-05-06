<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Set slug automatically
     */
    public function setNameAttribute($value) : void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories() : HasMany
    {
        return $this->hasMany(Subcategory::class)->has('products');
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}

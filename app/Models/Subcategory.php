<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'category_id',
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

    public function childcategories() : HasMany
    {
        return $this->hasMany(Childcategory::class)->has('products');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}

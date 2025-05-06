<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    //
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

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}

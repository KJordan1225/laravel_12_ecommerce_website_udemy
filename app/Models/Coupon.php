<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'expires_at'
    ];

    /**
     * Convert the coupon name to uppercase
     */
    public function setNameAttribute($value) : void
    {
        $this->attributes['name'] = Str::upper($value);
    }

    /**
     * Check if the coupon is valid
     */
    public function checkIfExpired() : bool
    {
        if($this->expires_at > date("Y-m-d")) {
            return false;
        }else {
            return true;
        }
    }
}

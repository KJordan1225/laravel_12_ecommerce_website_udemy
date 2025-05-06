<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'qty',
        'total',
        'delivered_at',
        'user_id',
        'coupon_id',
        'size',
        'color'
    ];

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon() : BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getDeliveredAtAttribute($value) : string | null
    {
        if($value) {
            return Carbon::parse($value)->diffForHumans();
        }else {
            return null;
        }
    }

    public function getCreatedAtAttribute($value) : string
    {
        return Carbon::parse($value)->diffForHumans();
    }
}

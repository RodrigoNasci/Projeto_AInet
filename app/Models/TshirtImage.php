<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TshirtImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'costumer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info',
    ];

    protected function fullImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image_url ? asset('storage/tshirt_images/' . $this->image_url) :
                    asset('/img/plain_white.png');
            },
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'tshirt_image_id');
    }
}

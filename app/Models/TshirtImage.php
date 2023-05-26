<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TshirtImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'costumer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info', 'created_at', 'updated_at', 'deleted_at'
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
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

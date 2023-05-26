<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'deleted_at'
    ];

    public function tshirtImages(): HasMany
    {
        return $this->hasMany(TShirt_Image::class, 'category_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TShirt_Image;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function tshirt()
    {
        return $this->hasMany(TShirt_Image::class, 'category_id');
    }
}

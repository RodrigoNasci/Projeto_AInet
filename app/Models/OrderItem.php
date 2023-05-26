<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id', 'order_id', 'tshirt_image_id', 'color_code', 'size',
        'qty', 'unit_price', 'sub_total'
    ];
}

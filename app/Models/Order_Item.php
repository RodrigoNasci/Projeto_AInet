<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TShirt_Image;
use App\Models\Color;
use App\Models\Order;

class Order_Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'tshirt_image_id',
        'color_code',
        'size',
        'qty',
        'unit_price',
        'sub_total'
    ];

    public function tshirt()
    {
        return $this->belongsTo(TShirt_Image::class, 'tshirt_image_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_code');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

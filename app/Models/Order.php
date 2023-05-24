<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Item;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'closed',
        'customer_id',
        'date',
        'total_price',
        'notes',
        'nif',
        'address',
        'payment_type',
        'payment_ref',
        'receipt_url'
    ];

    public function order_item()
    {
        return $this->hasMany(Order_Item::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TShirt_Image;
use App\Models\Order;
use App\Models\User;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    //protected $primaryKey = 'id';       //user id -> possivelmente criado qd o user é criado, logo terá o msm id (TODO)

    public $incrementing = false;

    protected $fillable = [
        'nif',
        'address',
        'default_payment_type',
        'default_payment_ref',

    ];

    public function tshirt()
    {
        return $this->hasMany(TShirt_Image::class, 'customer_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

}

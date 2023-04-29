<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Profil;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function profile()
    {
        return $this->hasOne(Profil::class, 'user_id', 'id')->withDefault();
    }
    public function address()
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)
            ->where('type', '=', 'billing');
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class,)->where('type', '=', 'shipping');;
    }
    public function user()
    {
        return $this->belongsTo(User::class)->default([
            'name' => 'Guest Customer'
        ]);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_items');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->as('order_item')
            ->withPivot('product_name', 'price', 'quantity');
    }
    public static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }
    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year();
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return  $year . '0001';
    }
}

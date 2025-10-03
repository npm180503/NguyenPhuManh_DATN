<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PAYMENT_SUCCESS = "success";
    const PAYMENT_FAILED  = "failed"; 
    use HasFactory;



    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($order) {
    //         // Nếu chưa có order_code thì random 10 ký tự
    //         if (empty($order->order_code)) {
    //             $order->order_code = Str::upper(Str::random(10));
    //         }
    //     });
    // }

    protected $fillable = ['order_code', 'user_id', 'customer_name', 'customer_phone', 'email', 'customer_address', 'status', 'total_price', 'payment_method', 'payment_status'];

    public function user()
    {
        return $this->belongsTo(User::class)->withoutGlobalScopes();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

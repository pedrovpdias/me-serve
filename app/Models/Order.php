<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersStatus;

class Order extends Model
{
    protected $fillable = [
        'orders_status_id',
        'total',
    ];

    public function status()
    {
        return $this->belongsTo(OrdersStatus::class, 'order_status_id');
    }
}

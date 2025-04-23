<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrdersStatus extends Model
{
    protected $fillable = [
        'name',
        'description',
        'order',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        //$id = $request->input('id'); dd($id);
        $order = Order::select(
            'order_products.*', 
            'orders.client_name', 
            'orders.total', 
            'products.name as product_name',
            'products.thumbnail',
            'products.description as product_description',
            'orders_status.description as order_status_description'
        )
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('orders_status', 'orders.order_status_id', '=', 'orders_status.id')
            ->where('orders.id', '=', 13)
            ->get();

        return response()->json($order);
    }
}

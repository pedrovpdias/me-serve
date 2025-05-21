<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;


class OrderController extends Controller
{
    // Retorna os detalhes do pedido
    public function index($id)
    {
        $order = Order::select(
            'order_products.*', 
            'orders.client_name', 
            'orders.total', 
            'products.name',
            'products.thumbnail',
            'products.description as product_description',
            'orders.order_status_id',
            'orders_status.description as order_status_description'
        )
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('orders_status', 'orders.order_status_id', '=', 'orders_status.id')
            ->where('orders.id', '=', $id)
            ->get();

        return response()->json($order);
    }

    // Atualiza o status do pedido
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status_id = $request->order_status_id;
        $order->save();

        $order = Order::select('orders.order_status_id', 'orders_status.description')
            ->join('orders_status', 'orders.order_status_id', '=', 'orders_status.id')
            ->where('orders.id', '=', $id)
            ->get();

        return response()->json($order);
    }
}

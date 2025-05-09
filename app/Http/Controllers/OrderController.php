<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Cria o pedido principal
            $order = new Order();
            $order->client_name = $request->input('client_name');
            $order->order_status_id = 1; // Pedido aguardando preparo
            $order->total = $request->input('total');
            $order->save();

            // Salvar os itens do pedido (order_product)
            $cartItems = $request->input('items');
            foreach ($cartItems as $item) {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $item['id'];
                $orderProduct->quantity = $item['quantity'];
                $orderProduct->unit_price = $item['price'];
                $orderProduct->save();
            }

            DB::commit();

            return response()->json(['message' => 'Pedido criado com sucesso!', 'order_id' => $order->id], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao criar o pedido.', 'details' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index(Request $request) {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        $sortField = $request->input('sort', 'id'); // Valor padrão para ordenação
        $sortDirection = $request->input('direction', 'desc'); // Valor padrão para direção
        

        $orders = Order::select('orders.*', 'orders_status.description')
            ->join('orders_status', 'orders.order_status_id', '=', 'orders_status.id')
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage); // Paginação dos pedidos
        return response()->json($orders);
    }
    
    // Cria um novo pedido
    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário
        
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

    // Retorna os 10 pedidos mais recentes
    public function latestOrders()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário
        
        $orders = Order::select('orders.*', 'orders_status.description')
            ->join('orders_status', 'orders.order_status_id', '=', 'orders_status.id')
            ->where('orders.order_status_id', '=', 1)
            ->orderBy('orders.created_at', 'desc')
            ->limit(5)
            ->get();
        
        return response()->json($orders);
    }

    // Conta quantos pedidos foram feitos hoje
    public function dailyOrdersCounter()
    {
        date_default_timezone_set('America/Sao_Paulo');
        
        $orders = Order::whereDate('created_at', today())->count();
        
        return response()->json($orders);
    }

    // Retorna o faturamento do dia
    public function dailyBilling()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário
        
        $billing = Order::whereDate('created_at', today())->sum('total');
        
        return response()->json($billing);
    }

    // Conta quantos produtos foram vendidos hoje
    public function dailyProductsSold()
    {
        date_default_timezone_set('America/Sao_Paulo');
        
        $productsSold = OrderProduct::whereDate('created_at', today())->count('product_id');
        
        return response()->json($productsSold);
    }

    // Retorna o total de produtos vendidos na última semana
    public function weeklyProductsSold()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário
        
        // Conta quantos produtos foram vendidos na última semana (7 dias)
        for($date = now()->subDays(6)->format('Y-m-d'); $date <= now()->format('Y-m-d'); $date++) {
            $productsSold[$date] = OrderProduct::whereDate('created_at', $date)->count('product_id');
        }
        return response()->json($productsSold);
    }

}

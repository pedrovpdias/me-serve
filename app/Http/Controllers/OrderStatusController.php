<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OrderStatusController extends Controller
{
    // Retorna os status de um pedido
    public function index() {
        $orderStatus = DB::table('orders_status')
            ->select('id', 'description')
            ->orderBy('order', 'asc')
            ->get();
        
        // Retorna os status de um pedido
        return response()->json($orderStatus);
    }
}

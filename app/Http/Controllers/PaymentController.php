<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Simulação simples de pagamento
    public function index()
    { 
        //Verifica se o status do pagamento ainda nao foi definido
        if (!session()->has('status_pagamento')) {
            session(['status_pagamento' => 'pendente']);
    
            // Muda automaticamente para 'aprovado' ou 'recusado'
            session(['tempo_pagamento' => now()->addSeconds(10)]);
        }
    
        // Simula o pagamento
        if (now()->greaterThanOrEqualTo(session('tempo_pagamento'))) {
            session(['status_pagamento' => rand(0, 1) ? 'aprovado' : 'recusado']);
        }
    
        return response()->json([
            'status' => session('status_pagamento')
        ]);
    }
}

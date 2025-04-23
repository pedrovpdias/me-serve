<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class OrdersStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders_status')->insert([
            [
                'name' => 'pending',
                'description' => 'Pedido aguardando preparo',
                'order' => 1,                
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'being_prepared',
                'description' => 'Sendo preparado', 
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ready',
                'description' => 'Pronto para retirada',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delivered', 
                'description' => 'Entregue ao cliente',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

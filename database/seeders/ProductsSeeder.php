<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Hambúrguer Clássico',
                'description' => 'Pão com gergelim, um hambúrguer de carne 100% bovino grelhado no fogo, alface fresquinha, tomate, cebola, fatias de queijo derretido sabor cheddar.',
                'price' => 8.99,
                'thumbnail' => 'storage/products/hamburger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Cheeseburger Duplo',
                'description' => 'Dois hambúrgueres suculentos cobertos com queijo cheddar derretido e bacon crocante.',
                'price' => 12.50,
                'thumbnail' => 'storage/products/double_cheeseburger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Chicken Crispy',
                'description' => 'Um delicioso e suculento filé de frango empanado crocante servido no pão com alface fresca e tomate.',
                'price' => 9.50,
                'thumbnail' => 'storage/products/chicken_hamburger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Casquinha de Chocolate',
                'description' => 'Sorvete de casquinha cremoso sabor chocolate.',
                'price' => 4.75,
                'thumbnail' => 'storage/products/chocolate_ice_cream.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Casquinha de Baunilha',
                'description' => 'Sorvete de casquinha cremoso sabor baunilha.',
                'price' => 4.50,
                'thumbnail' => 'storage/products/vanilla_ice_cream.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Refrigerante Cola',
                'description' => 'Bebida gaseificada refrescante com sabor de cola.',
                'price' => 3.00,
                'thumbnail' => 'storage/products/cola_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Refrigerante de Laranja',
                'description' => 'Bebida gaseificada refrescante com sabor de laranja.',
                'price' => 3.00,
                'thumbnail' => 'storage/products/orange_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
            [
                'category_id' => 3,
                'name' => 'Refrigerante de Limão e Lima',
                'description' => 'Bebida gaseificada refrescante com sabor de limão e lima.',
                'price' => 3.00,
                'thumbnail' => 'storage/products/lemon_lime_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Batata Frita',
                'description' => 'Tiras de batata fritas crocantes e douradas.',
                'price' => 5.50,
                'thumbnail' => 'storage/products/french_fries.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

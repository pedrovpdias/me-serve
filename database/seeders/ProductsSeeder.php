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
                'description' => 'Pão com gergelim, um hambúrguer de carne 100% bovino grelhado no fogo, alface fresquinha, tomate, cebola, pícles, fatias de queijo derretido sabor cheddar.',
                'price' => 22.90,
                'thumbnail' => 'storage/products/hamburger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Cheeseburger Duplo',
                'description' => 'Dois hambúrgueres suculentos cobertos com queijo cheddar derretido e bacon crocante.',
                'price' => 28.90,
                'thumbnail' => 'storage/products/double_cheeseburger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Crispy Chicken Burger',
                'description' => 'Um delicioso e suculento filé de frango empanado crocante servido no pão com alface fresca, pícles e tomate.',
                'price' => 23.90,
                'thumbnail' => 'storage/products/crispy_chicken_burger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
            [
                'category_id' => 1,
                'name' => 'Crispy King Burger',
                'description' => 'Dois suculentos filés de frango empanados, dourados e crocantes, montados em pão macio com alface fresca, queijo cremoso e um toque especial de maionese temperada.',
                'price' => 29.90,
                'thumbnail' => 'storage/products/crispy_king_burger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Casquinha de Chocolate',
                'description' => 'Sorvete de casquinha cremoso sabor chocolate.',
                'price' => 5.50,
                'thumbnail' => 'storage/products/chocolate_ice_cream.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Casquinha de Baunilha',
                'description' => 'Sorvete de casquinha cremoso sabor baunilha.',
                'price' => 5.50,
                'thumbnail' => 'storage/products/vanilla_ice_cream.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Refrigerante Cola',
                'description' => 'Bebida gaseificada refrescante com sabor de cola.',
                'price' => 7.00,
                'thumbnail' => 'storage/products/cola_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Refrigerante de Laranja',
                'description' => 'Bebida gaseificada refrescante com sabor de laranja.',
                'price' => 7.00,
                'thumbnail' => 'storage/products/orange_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],            
            [
                'category_id' => 3,
                'name' => 'Refrigerante de Limão e Lima',
                'description' => 'Bebida gaseificada refrescante com sabor de limão e lima.',
                'price' => 7.00,
                'thumbnail' => 'storage/products/lemon_lime_soda.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Batata Frita',
                'description' => 'Tiras de batata fritas crocantes e douradas.',
                'price' => 12.00,
                'thumbnail' => 'storage/products/french_fries.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Brownie de Chocolate',
                'description' => 'Brownie artesanal de chocolate meio amargo, com casquinha crocante por fora e interior macio e úmido. Perfeito para quem ama um doce intenso, rico e irresistivelmente cremoso.',
                'price' => 11.00,
                'thumbnail' => 'storage/products/brownie.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'VanillaDream Mix',
                'description' => 'Sorvete cremoso de baunilha com calda e pedaços crocantes de chocolate misturados.',
                'price' => 12.90,
                'thumbnail' => 'storage/products/vanilla_dream_mix.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'ChocolateDream Mix',
                'description' => 'Sorvete de baunilha com pedaços de chocolate ao leite e crocante de amendoim, coberto com calda de chocolate.',
                'price' => 13.90,
                'thumbnail' => 'storage/products/chocolate_dream_mix.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'OreoDream Mix',
                'description' => 'Sorvete de baunilha misturado com pedaços de biscoito Oreo e cobertura de chocolate.',
                'price' => 13.90,
                'thumbnail' => 'storage/products/oreo_dream_mix.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Onion Rings',
                'description' => 'Uma porção clássica e saborosa de anéis de cebola empanados e fritos até ficarem dourados e crocantes.',
                'price' => 12.00,
                'thumbnail' => 'storage/products/onion_rings.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Nuggets de Frango',
                'description' => 'Pequenos pedaços de frango empanados e fritos, oferecendo uma opção prática e saborosa para todas as idades.',
                'price' => 14.90,
                'thumbnail' => 'storage/products/nuggets.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
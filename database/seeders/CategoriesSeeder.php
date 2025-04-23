<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Hambúrgueres',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sorvetes',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Refrigerantes',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Acompanhamentos',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

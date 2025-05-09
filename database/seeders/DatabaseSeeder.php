<?php

namespace Database\Seeders;

use App\Models\OrdersStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@meserve.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        $this->call([
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrdersStatusSeeder::class,
        ]);
    }
}

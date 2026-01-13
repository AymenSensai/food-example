<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $burgers = Category::create([
            'name' => 'Burgers',
            'description' => 'Juicy and delicious burgers',
            'image' => 'https://via.placeholder.com/150',
        ]);

        FoodItem::create([
            'category_id' => $burgers->id,
            'name' => 'Cheeseburger',
            'description' => 'Classic burger with cheese',
            'price' => 9.99,
            'image' => 'https://via.placeholder.com/150',
        ]);

        FoodItem::create([
            'category_id' => $burgers->id,
            'name' => 'Bacon Burger',
            'description' => 'Burger with crispy bacon',
            'price' => 11.99,
            'image' => 'https://via.placeholder.com/150',
        ]);

        $drinks = Category::create([
            'name' => 'Drinks',
            'description' => 'Refreshing beverages',
            'image' => 'https://via.placeholder.com/150',
        ]);

        FoodItem::create([
            'category_id' => $drinks->id,
            'name' => 'Coke',
            'description' => 'Chilled Coca-Cola',
            'price' => 1.99,
            'image' => 'https://via.placeholder.com/150',
        ]);
        
        FoodItem::create([
            'category_id' => $drinks->id,
            'name' => 'Water',
            'description' => 'Mineral water',
            'price' => 0.99,
            'image' => 'https://via.placeholder.com/150',
        ]);

        $this->call([
            CompanySettingSeeder::class,
        ]);
    }
}

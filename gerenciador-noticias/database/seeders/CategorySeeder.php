<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Tecnologia']);
        Category::create(['name' => 'Esportes']);
        Category::create(['name' => 'Finanças']);
        Category::create(['name' => 'Saúde']);
        Category::create(['name' => 'Cultura']);
    }
}

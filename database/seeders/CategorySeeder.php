<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Processors', 'slug' => 'processors', 'description' => 'CPUs for all socket types'],
            ['name' => 'Motherboards', 'slug' => 'motherboards', 'description' => 'Mainboards for Intel and AMD'],
            ['name' => 'Graphics Cards', 'slug' => 'graphics-cards', 'description' => 'GPUs for gaming and productivity'],
            ['name' => 'Memory', 'slug' => 'memory', 'description' => 'DDR4, DDR5 RAM modules'],
            ['name' => 'Storage', 'slug' => 'storage', 'description' => 'NVMe, SSD, and HDD drives'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}

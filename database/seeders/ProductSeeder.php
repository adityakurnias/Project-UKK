<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'Intel Core i9-14900K', 'slug' => 'intel-core-i9-14900k', 'price' => 9500000, 'stock' => 15],
            ['category_id' => 1, 'name' => 'AMD Ryzen 9 7950X3D', 'slug' => 'amd-ryzen-9-7950x3d', 'price' => 10500000, 'stock' => 10],
            ['category_id' => 1, 'name' => 'Intel Core i5-13600K', 'slug' => 'intel-core-i5-13600k', 'price' => 4500000, 'stock' => 25],

            ['category_id' => 2, 'name' => 'ASUS ROG Maximus Z790 Hero', 'slug' => 'asus-rog-maximus-z790-hero', 'price' => 11000000, 'stock' => 5],
            ['category_id' => 2, 'name' => 'MSI MAG B650 TOMAHAWK WIFI', 'slug' => 'msi-mag-b650-tomahawk-wifi', 'price' => 3800000, 'stock' => 12],

            ['category_id' => 3, 'name' => 'NVIDIA GeForce RTX 4090 FE', 'slug' => 'nvidia-geforce-rtx-4090-fe', 'price' => 35000000, 'stock' => 3],
            ['category_id' => 3, 'name' => 'ASUS TUF Gaming Radeon RX 7900 XTX', 'slug' => 'asus-tuf-gaming-radeon-rx-7900-xtx', 'price' => 18500000, 'stock' => 8],
            ['category_id' => 3, 'name' => 'ZOTAC GAMING GeForce RTX 4070 Ti', 'slug' => 'zotac-gaming-geforce-rtx-4070-ti', 'price' => 14000000, 'stock' => 15],

            ['category_id' => 4, 'name' => 'Corsair Dominator Titanium 64GB (2x32) DDR5', 'slug' => 'corsair-dominator-titanium-64gb-ddr5', 'price' => 5500000, 'stock' => 20],
            ['category_id' => 4, 'name' => 'G.Skill Trident Z5 RGB 32GB (2x16) DDR5', 'slug' => 'gskill-trident-z5-rgb-32gb-ddr5', 'price' => 2800000, 'stock' => 30],

            ['category_id' => 5, 'name' => 'Samsung 990 PRO 2TB NVMe M.2', 'slug' => 'samsung-990-pro-2tb-nvme', 'price' => 3200000, 'stock' => 40],
            ['category_id' => 5, 'name' => 'WD Black SN850X 1TB NVMe', 'slug' => 'wd-black-sn850x-1tb', 'price' => 1800000, 'stock' => 50],
        ];

        foreach ($products as &$product) {
            // Create a dummy image using PHP GD
            $width = 600;
            $height = 400;
            $image = imagecreatetruecolor($width, $height);

            // Random vibrant background color
            $bgColor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
            $textColor = imagecolorallocate($image, 255, 255, 255);

            imagefill($image, 0, 0, $bgColor);

            // Add text (simple centered approximation)
            $text = $product['name'];
            $fontWidth = imagefontwidth(5);
            $fontHeight = imagefontheight(5);
            $textWidth = $fontWidth * strlen($text);
            $x = ($width - $textWidth) / 2;
            $y = ($height - $fontHeight) / 2;

            imagestring($image, 5, $x, $y, $text, $textColor);

            ob_start();
            imagejpeg($image, null, 90);
            $imageContent = ob_get_clean();
            imagedestroy($image);

            $fileName = 'products/seed_' . $product['slug'] . '.jpg';
            \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $imageContent);

            $product['image_path'] = $fileName;

            \App\Models\Product::create($product);
        }
    }
}

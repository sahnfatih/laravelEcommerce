<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Trendyol API endpoint'i
        $apiUrl = 'https://api.trendyol.com/sapigw/product-categories/';

        // Her kategori için ürün oluştur
        Category::whereNotNull('parent_id')->get()->each(function ($category) {
            // Her kategori için 20 ürün oluştur
            for ($i = 1; $i <= 20; $i++) {
                $faker = \Faker\Factory::create('tr_TR');

                // Ürün fiyatı ve indirim hesaplama
                $originalPrice = $faker->randomFloat(2, 50, 5000);
                $discountRate = $faker->randomElement([0, 10, 20, 30, 40, 50]);
                $finalPrice = $originalPrice * (1 - ($discountRate / 100));

                Product::create([
                    'category_id' => $category->category_id,
                    'name' => $this->generateProductName($category->name),
                    'slug' => Str::slug($this->generateProductName($category->name)),
                    'description' => $this->generateProductDescription(),
                    'price' => $finalPrice,
                    'original_price' => $originalPrice,
                    'discount_rate' => $discountRate,
                    'stock' => $faker->numberBetween(0, 100),
                    'image' => $this->getRandomProductImage($category->name),
                    'is_active' => true,
                    'specifications' => $this->generateSpecifications($category->name),
                ]);
            }
        });
    }

    private function generateProductName($category)
    {
        $faker = \Faker\Factory::create('tr_TR');

        $brands = [
            'Telefon' => ['Apple', 'Samsung', 'Xiaomi', 'Huawei', 'Oppo'],
            'Bilgisayar' => ['Lenovo', 'HP', 'Dell', 'Asus', 'MSI'],
            'Erkek Giyim' => ['Koton', 'LC Waikiki', 'DeFacto', 'Mavi', 'Pull&Bear'],
            'Kadın Giyim' => ['Zara', 'H&M', 'Bershka', 'Stradivarius', 'Koton'],
            // Diğer kategoriler için markalar...
        ];

        $brand = $faker->randomElement($brands[$category] ?? ['Marka']);
        $model = $faker->words(2, true);

        return "$brand $model";
    }

    private function generateProductDescription()
    {
        $faker = \Faker\Factory::create('tr_TR');

        $features = [
            $faker->paragraph(1),
            "Özellikler:",
            "- " . $faker->sentence(),
            "- " . $faker->sentence(),
            "- " . $faker->sentence(),
            "\nÖnemli Bilgiler:",
            "- " . $faker->sentence(),
            "- " . $faker->sentence()
        ];

        return implode("\n", $features);
    }

    private function getRandomProductImage($category)
    {
        // Kategoriye göre ilgili görselleri döndür
        $images = [
            'Telefon' => [
                'https://picsum.photos/400/400?category=phone',
                // Diğer telefon görselleri...
            ],
            // Diğer kategoriler için görseller...
        ];

        return $images[$category][0] ?? 'https://picsum.photos/400/400';
    }

    private function generateSpecifications($category)
    {
        $faker = \Faker\Factory::create('tr_TR');

        $specs = [
            'Telefon' => [
                'Ekran' => $faker->randomElement(['6.1"', '6.4"', '6.7"']),
                'RAM' => $faker->randomElement(['4GB', '6GB', '8GB']),
                'Depolama' => $faker->randomElement(['64GB', '128GB', '256GB']),
                'Kamera' => $faker->randomElement(['12MP', '48MP', '64MP']),
                'Batarya' => $faker->randomElement(['4000mAh', '5000mAh', '6000mAh'])
            ],
            // Diğer kategoriler için özellikler...
        ];

        return json_encode($specs[$category] ?? [], JSON_UNESCAPED_UNICODE);
    }
}

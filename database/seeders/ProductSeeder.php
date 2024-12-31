<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    private $brands = [
        'Cep Telefonu' => ['Samsung', 'iPhone', 'Xiaomi', 'Huawei', 'Oppo'],
        'Laptop' => ['Lenovo', 'HP', 'Dell', 'Asus', 'Monster'],
        'Tablet' => ['iPad', 'Samsung', 'Lenovo', 'Huawei'],
        'Kulaklık' => ['JBL', 'Sony', 'Apple', 'Samsung', 'Philips'],
        'Erkek Giyim' => ['Koton', 'DeFacto', 'LC Waikiki', 'Mavi', 'Pull&Bear'],
        'Kadın Giyim' => ['Zara', 'H&M', 'Koton', 'Mango', 'Bershka'],
        'Ayakkabı' => ['Nike', 'Adidas', 'Puma', 'New Balance', 'Skechers'],
        'Çanta' => ['Derimod', 'Zara', 'Michael Kors', 'Tommy Hilfiger'],
        'Mobilya' => ['Bellona', 'İstikbal', 'Mondi', 'Çilek'],
        'Ev Tekstili' => ['Madame Coco', 'English Home', 'Karaca Home'],
        'Mutfak' => ['Karaca', 'Bernardo', 'Paşabahçe', 'Arzum'],
        'Dekorasyon' => ['Madame Coco', 'English Home', 'Zara Home']
    ];

    private $productTypes = [
        'Cep Telefonu' => ['Pro', 'Max', 'Plus', 'Lite', 'Ultra'],
        'Laptop' => ['Gaming', 'Ultrabook', 'Notebook', 'Workstation'],
        'Tablet' => ['Pro', 'Air', 'Lite', 'Plus'],
        'Kulaklık' => ['Wireless', 'Pro', 'Sport', 'Gaming'],
        'Erkek Giyim' => ['T-Shirt', 'Gömlek', 'Pantolon', 'Ceket', 'Kazak'],
        'Kadın Giyim' => ['Elbise', 'Bluz', 'Pantolon', 'Etek', 'Kazak'],
        'Ayakkabı' => ['Spor', 'Günlük', 'Bot', 'Sneaker'],
        'Çanta' => ['El Çantası', 'Sırt Çantası', 'Omuz Çantası', 'Cüzdan'],
        'Mobilya' => ['Koltuk', 'Yatak', 'Dolap', 'Masa', 'Sandalye'],
        'Ev Tekstili' => ['Nevresim', 'Havlu', 'Perde', 'Halı'],
        'Mutfak' => ['Tencere', 'Tava', 'Bardak', 'Çatal-Kaşık'],
        'Dekorasyon' => ['Vazo', 'Ayna', 'Çerçeve', 'Abajur']
    ];

    public function run()
    {
        $faker = \Faker\Factory::create('tr_TR');

        Category::whereNotNull('parent_id')->get()->each(function ($category) use ($faker) {
            $categoryName = $category->name;
            $brands = $this->brands[$categoryName] ?? ['Marka'];
            $types = $this->productTypes[$categoryName] ?? ['Model'];

            for ($i = 1; $i <= 15; $i++) {
                $brand = $faker->randomElement($brands);
                $type = $faker->randomElement($types);
                $name = "$brand $type " . $faker->words(2, true);

                $originalPrice = $faker->randomFloat(2, 100, 10000);
                $discountRate = $faker->randomElement([0, 10, 20, 30, 40, 50]);
                $finalPrice = $originalPrice * (1 - ($discountRate / 100));

                // Ürün resmi
                $imageNumber = rand(1, 1000);
                $imageName = "product_{$category->slug}_{$i}_{$imageNumber}.jpg";

                // Resmi indir ve kaydet
                $imageContent = file_get_contents("https://picsum.photos/800/600?random={$imageNumber}");
                Storage::put("public/products/{$imageName}", $imageContent);

                $product = Product::create([
                    'category_id' => $category->category_id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $this->generateDescription($categoryName, $brand, $type),
                    'price' => $finalPrice,
                    'original_price' => $originalPrice,
                    'discount_rate' => $discountRate,
                    'stock' => $faker->numberBetween(0, 100),
                    'image' => "products/{$imageName}",
                    'specifications' => $this->generateSpecifications($categoryName, $faker),
                    'is_active' => true
                ]);

                // Ürün resmi için ProductImage kaydı
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_url' => "products/{$imageName}",
                    'alt' => $name,
                    'seq' => 1,
                    'is_active' => true
                ]);
            }
        });
    }

    private function generateDescription($category, $brand, $type)
    {
        $faker = \Faker\Factory::create('tr_TR');

        return implode("\n\n", [
            "$brand marka $type ürünü şimdi çok uygun fiyatlarla!",
            "Özellikler:",
            "- " . $faker->sentence(),
            "- " . $faker->sentence(),
            "- " . $faker->sentence(),
            "\nÖnemli Bilgiler:",
            "- Orijinal " . $brand . " ürünüdür",
            "- 2 yıl garanti",
            "- Ücretsiz kargo"
        ]);
    }

    private function generateSpecifications($category, $faker)
    {
        $specs = [
            'Cep Telefonu' => [
                'Ekran' => $faker->randomElement(['6.1"', '6.4"', '6.7"']),
                'RAM' => $faker->randomElement(['4GB', '6GB', '8GB']),
                'Depolama' => $faker->randomElement(['64GB', '128GB', '256GB']),
                'Kamera' => $faker->randomElement(['12MP', '48MP', '64MP']),
                'Batarya' => $faker->randomElement(['4000mAh', '5000mAh', '6000mAh'])
            ],
            'Laptop' => [
                'İşlemci' => $faker->randomElement(['Intel i5', 'Intel i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
                'RAM' => $faker->randomElement(['8GB', '16GB', '32GB']),
                'Depolama' => $faker->randomElement(['256GB SSD', '512GB SSD', '1TB SSD']),
                'Ekran' => $faker->randomElement(['14"', '15.6"', '17.3"'])
            ]
        ];

        return json_encode($specs[$category] ?? [], JSON_UNESCAPED_UNICODE);
    }
}

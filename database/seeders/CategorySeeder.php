<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Elektronik' => [
                'Cep Telefonu' => [
                    'description' => 'En yeni model cep telefonları uygun fiyatlarla'
                ],
                'Laptop' => [
                    'description' => 'Güçlü ve taşınabilir dizüstü bilgisayarlar'
                ],
                'Tablet' => [
                    'description' => 'Her ihtiyaca uygun tablet modelleri'
                ],
                'Kulaklık' => [
                    'description' => 'Kablolu ve kablosuz kulaklık modelleri'
                ]
            ],
            'Giyim' => [
                'Erkek Giyim' => [
                    'description' => 'Şık ve rahat erkek giyim ürünleri'
                ],
                'Kadın Giyim' => [
                    'description' => 'Trend kadın giyim koleksiyonu'
                ],
                'Ayakkabı' => [
                    'description' => 'Ayakkabı ve bot modelleri'
                ],
                'Çanta' => [
                    'description' => 'Her tarza uygun çanta modelleri'
                ]
            ],
            'Ev Yaşam' => [
                'Mobilya' => [
                    'description' => 'Modern ve kullanışlı mobilyalar'
                ],
                'Ev Tekstili' => [
                    'description' => 'Kaliteli ev tekstili ürünleri'
                ],
                'Mutfak' => [
                    'description' => 'Mutfak gereçleri ve ekipmanları'
                ],
                'Dekorasyon' => [
                    'description' => 'Eviniz için dekoratif ürünler'
                ]
            ]
        ];

        foreach ($categories as $mainCategory => $subCategories) {
            // Ana kategori için resim
            $imageNumber = rand(1, 1000);
            $imageName = "category_{$imageNumber}.jpg";

            // Resmi indir ve kaydet
            $imageContent = file_get_contents("https://picsum.photos/800/600?random={$imageNumber}");
            Storage::put("public/categories/{$imageName}", $imageContent);

            $parent = Category::create([
                'name' => $mainCategory,
                'slug' => Str::slug($mainCategory),
                'image' => "categories/{$imageName}",
                'description' => "En iyi $mainCategory ürünleri",
                'is_active' => true
            ]);

            foreach ($subCategories as $name => $details) {
                // Alt kategori için resim
                $imageNumber = rand(1, 1000);
                $imageName = "subcategory_{$name}_{$imageNumber}.jpg";

                // Resmi indir ve kaydet
                $imageContent = file_get_contents("https://picsum.photos/800/600?random={$imageNumber}");
                Storage::put("public/categories/{$imageName}", $imageContent);

                Category::create([
                    'parent_id' => $parent->category_id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'image' => "categories/{$imageName}",
                    'description' => $details['description'],
                    'is_active' => true
                ]);
            }
        }
    }
}

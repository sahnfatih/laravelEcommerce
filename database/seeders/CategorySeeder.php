<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Elektronik' => [
                'Cep Telefonu' => [
                    'image' => 'categories/elektronik/telefon.jpg',
                    'description' => 'En yeni model cep telefonları uygun fiyatlarla'
                ],
                'Laptop' => [
                    'image' => 'categories/elektronik/laptop.jpg',
                    'description' => 'Güçlü ve taşınabilir dizüstü bilgisayarlar'
                ],
                'Tablet' => [
                    'image' => 'categories/elektronik/tablet.jpg',
                    'description' => 'Her ihtiyaca uygun tablet modelleri'
                ],
                'Kulaklık' => [
                    'image' => 'categories/elektronik/kulaklik.jpg',
                    'description' => 'Kablolu ve kablosuz kulaklık modelleri'
                ]
            ],
            'Giyim' => [
                'Erkek Giyim' => [
                    'image' => 'categories/giyim/erkek.jpg',
                    'description' => 'Şık ve rahat erkek giyim ürünleri'
                ],
                'Kadın Giyim' => [
                    'image' => 'categories/giyim/kadin.jpg',
                    'description' => 'Trend kadın giyim koleksiyonu'
                ],
                'Ayakkabı' => [
                    'image' => 'categories/giyim/ayakkabi.jpg',
                    'description' => 'Ayakkabı ve bot modelleri'
                ],
                'Çanta' => [
                    'image' => 'categories/giyim/canta.jpg',
                    'description' => 'Her tarza uygun çanta modelleri'
                ]
            ],
            'Ev Yaşam' => [
                'Mobilya' => [
                    'image' => 'categories/ev/mobilya.jpg',
                    'description' => 'Modern ve kullanışlı mobilyalar'
                ],
                'Ev Tekstili' => [
                    'image' => 'categories/ev/tekstil.jpg',
                    'description' => 'Kaliteli ev tekstili ürünleri'
                ],
                'Mutfak' => [
                    'image' => 'categories/ev/mutfak.jpg',
                    'description' => 'Mutfak gereçleri ve ekipmanları'
                ],
                'Dekorasyon' => [
                    'image' => 'categories/ev/dekorasyon.jpg',
                    'description' => 'Eviniz için dekoratif ürünler'
                ]
            ]
        ];

        foreach ($categories as $mainCategory => $subCategories) {
            $parent = Category::create([
                'name' => $mainCategory,
                'slug' => Str::slug($mainCategory),
                'image' => 'categories/' . Str::slug($mainCategory) . '.jpg',
                'description' => "En iyi $mainCategory ürünleri",
                'is_active' => true
            ]);

            foreach ($subCategories as $name => $details) {
                Category::create([
                    'parent_id' => $parent->category_id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'image' => $details['image'],
                    'description' => $details['description'],
                    'is_active' => true
                ]);
            }
        }
    }
}

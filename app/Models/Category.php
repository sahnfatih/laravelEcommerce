<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "category_id";

    protected $fillable = [
        "category_id",
        "parent_id",
        "name",
        "slug",
        "image",
        "description",
        "is_active"
    ];

    // Ana kategorinin alt kategorileri
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    // Alt kategorinin ana kategorisi
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }

    // Kategoriye ait ürünler
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    // Ürün sayısını almak için
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
}

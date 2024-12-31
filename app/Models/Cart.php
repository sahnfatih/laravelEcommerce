<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "cart_id";

    protected $fillable = [
        'user_id',
        'code',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(CartDetails::class, 'cart_id', 'cart_id');
    }
    public function getTotalItemsAttribute()
{
    return $this->details()->sum('quantity');
}
}

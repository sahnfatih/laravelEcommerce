<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'payment_method',
        'payment_id',
        'transaction_id',
        'address',
        'city',
        'district',
        'postal_code',
        'phone',
        'notes',
        'paid_at'
    ];

    protected $dates = [
        'paid_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'order_id');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">Beklemede</span>',
            'paid' => '<span class="badge bg-success">Ödendi</span>',
            'processing' => '<span class="badge bg-info">İşleniyor</span>',
            'shipped' => '<span class="badge bg-primary">Kargoda</span>',
            'delivered' => '<span class="badge bg-success">Teslim Edildi</span>',
            'cancelled' => '<span class="badge bg-danger">İptal Edildi</span>',
            'payment_failed' => '<span class="badge bg-danger">Ödeme Başarısız</span>',
            default => '<span class="badge bg-secondary">Belirsiz</span>'
        };
    }
}

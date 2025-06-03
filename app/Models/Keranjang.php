<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';

    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah',
        'harga'
    ];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Product
     */
    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    /**
     * Menghitung subtotal untuk item ini
     */
    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga;
    }

    /**
     * Scope untuk mendapatkan keranjang user tertentu
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
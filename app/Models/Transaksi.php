<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'produk_id',
        'qty',
        'ongkir',
        'total_bayar',
        'status',
        'no_resi',
        'status_pengiriman'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}

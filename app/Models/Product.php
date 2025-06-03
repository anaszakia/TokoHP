<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Transaksi;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'nama', 'harga_semula', 'harga_sekarang', 'stok',
        'warna', 'jaringan', 'sistem_operasi', 'prosesor', 'gpu', 'ram', 'rom',
        'ukuran_layar', 'tipe_layar', 'resolusi_layar', 'kamera_belakang', 'kamera_depan',
        'audio', 'wlan', 'bluetooth', 'gps', 'sensor', 'baterai', 'pengisi_daya',
        'slot_memori_eksternal', 'sim', 'berat', 'dimensi', 'lainnya','description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}


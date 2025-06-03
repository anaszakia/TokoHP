<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\ProductImage;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Ambil data gambar dan hapus dari array agar tidak disimpan di tabel products
        $images = $data['uploaded_images'] ?? [];
        unset($data['uploaded_images']);

        // Simpan produk
        $product = static::getModel()::create($data);

        // Simpan gambar ke tabel product_images
        foreach ($images as $imagePath) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }

        return $product;
    }
}

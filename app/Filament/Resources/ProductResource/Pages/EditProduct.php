<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use App\Models\ProductImage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProductResource;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        // Ambil data gambar dan hapus dari array data utama
        $newImages = $data['uploaded_images'] ?? [];
        unset($data['uploaded_images']);

        // Update data produk
        $record->update($data);

        // Hapus gambar yang tidak ada lagi
        $existingImages = $record->images->pluck('image_path')->toArray();
        $deletedImages = array_diff($existingImages, $newImages);

        foreach ($deletedImages as $path) {
            ProductImage::where('product_id', $record->id)
                ->where('image_path', $path)
                ->delete();
        }

        // Tambah gambar baru (yang belum ada di database)
        $existingSet = collect($existingImages);
        foreach ($newImages as $path) {
            if (!$existingSet->contains($path)) {
                ProductImage::create([
                    'product_id' => $record->id,
                    'image_path' => $path,
                ]);
            }
        }

        return $record;
    }
}

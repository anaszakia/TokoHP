<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $navigationGroup = 'Management Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga_semula')
                    ->numeric(),
                Forms\Components\TextInput::make('harga_sekarang')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('stok')
                    ->required(),
                Forms\Components\TextInput::make('warna')
                    ->maxLength(255),
                Forms\Components\TextInput::make('jaringan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sistem_operasi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('prosesor')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gpu')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ram')
                    ->maxLength(255),
                Forms\Components\TextInput::make('rom')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ukuran_layar')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tipe_layar')
                    ->maxLength(255),
                Forms\Components\TextInput::make('resolusi_layar')
                    ->maxLength(255),
                Forms\Components\TextInput::make('kamera_belakang')
                    ->maxLength(255),
                Forms\Components\TextInput::make('kamera_depan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('audio')
                    ->maxLength(255),
                Forms\Components\TextInput::make('wlan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bluetooth')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gps')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sensor')
                    ->maxLength(255),
                Forms\Components\TextInput::make('baterai')
                    ->maxLength(255),
                Forms\Components\TextInput::make('pengisi_daya')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slot_memori_eksternal')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sim')
                    ->maxLength(255),
                Forms\Components\TextInput::make('berat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dimensi')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\Textarea::make('lainnya')
                    ->columnSpanFull(),
               Forms\Components\FileUpload::make('uploaded_images')
                    ->label('Gambar Produk')
                    ->multiple()
                    ->image()
                    ->directory('product-images')
                    ->reorderable()
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->getClientOriginalName())
                    ->default(function ($record) {
                        return $record?->images->pluck('image_path')->toArray(); // ambil dari relasi images
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_semula')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_sekarang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('stok')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('warna')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('jaringan')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('sistem_operasi')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('prosesor')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('gpu')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('ram')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('rom')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('ukuran_layar')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tipe_layar')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('resolusi_layar')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('kamera_belakang')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('kamera_depan')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('audio')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('wlan')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('bluetooth')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('gps')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('sensor')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('baterai')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('pengisi_daya')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('slot_memori_eksternal')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('sim')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('berat')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('dimensi')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

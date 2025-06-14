<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'User';
    protected static ?string $navigationGroup = 'User Management'; // Ini untuk grup menu
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label(__('Password'))
                    ->maxLength(255)
                    ->revealable()
                    ->placeholder(fn (string $context): string => $context === 'edit' ? 'Tidak usah di isi jika tidak ingin mengganti password' : '')
                    ->dehydrated(fn ($state) => filled($state))
                    ->confirmed()
                    ->rules(['confirmed'])
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->required(fn (string $context): bool => $context === 'create')
                    ->same('password_confirmation'),

                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->label(__('Confirm Password'))
                    ->maxLength(255)
                    ->revealable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(false)
                    ->placeholder(fn (string $context): string => $context === 'edit' ? 'Tidak usah di isi jika tidak ingin mengganti password' : ''),
                Forms\Components\TextInput::make('no_hp')
                    ->label('Nomor HP/WA')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('province_id')
                    ->label('Provinsi')
                    ->required(),
                Forms\Components\TextInput::make('city_id')
                    ->label('Kota / Kabupaten')
                    ->required(),
                Forms\Components\TextInput::make('kode_pos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

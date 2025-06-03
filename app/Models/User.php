<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat_lengkap',
        'province_id',
        'city_id',
        'kode_pos'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Mendapatkan total item di keranjang user
     */
    public function getTotalKeranjangAttribute()
    {
        return $this->keranjang()->sum('jumlah');
    }

    /**
     * Mendapatkan total harga keranjang user
     */
    public function getTotalHargaKeranjangAttribute()
    {
        return $this->keranjang()->get()->sum('subtotal');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}

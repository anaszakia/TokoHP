@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="min-h-screen bg-gray-50 py-4 px-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Simpel -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Riwayat Transaksi</h1>
            <p class="text-gray-600 text-sm">Pantau semua aktivitas belanja Anda</p>
        </div>

        <!-- Filter Sederhana -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <select class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                    <option value="shipped">Dikirim</option>
                </select>
                <input type="month" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                <select class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="highest">Tertinggi</option>
                    <option value="lowest">Terendah</option>
                </select>
                <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    Filter
                </button>
            </div>
        </div>

        <!-- Transaction Cards -->
        <div class="space-y-4">
            @foreach ($riwayat as $item)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                
                <!-- Header Card -->
                <div class="border-l-4 border-blue-500 bg-gray-50 p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="space-y-1">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    #{{ $item->order_id }}
                                </h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full w-fit">
                                    {{ ucfirst($item->status_pengiriman) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p>Resi: {{ $item->no_resi ?? 'Belum tersedia' }}</p>
                                <p>{{ date('d M Y', strtotime($item->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-gray-900">
                                Rp {{ number_format(($item->total_bayar ?? 0)) }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $item->qty }} barang
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <div class="flex gap-4">
                        <div class="relative flex-shrink-0">
                            <img src="{{ asset('storage/' . ($item->produk->images->first()->image_path ?? 'placeholder.jpg')) }}"
                                alt="{{ $item->produk->nama }}"
                                class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg">
                            <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $item->qty }}
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ $item->produk->nama ?? 'Produk tidak ditemukan' }}
                            </h4>
                            <div class="flex flex-wrap gap-1 mb-2">
                                @if($item->produk->warna)
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">{{ $item->produk->warna }}</span>
                                @endif
                                @if($item->produk->rom)
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded">{{ $item->produk->rom }}</span>
                                @endif
                                @if($item->produk->sistem_operasi)
                                <span class="px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded">{{ $item->produk->sistem_operasi }}</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">Status Pembayaran: {{ ucfirst($item->status) }}</p>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <h5 class="text-sm font-medium text-gray-900 mb-3">Kontak</h5>
                        <div class="space-y-2">
                            <!-- Address -->
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">
                                        {{ $item->user->alamat_lengkap ?? 'Jl. Contoh Alamat No. 123, Kota Contoh, Provinsi 12345' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">
                                        {{ $item->user->no_hp ?? '+62 812-3456-7890' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">
                                        {{ $item->user->email ?? 'customer@example.com' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-gray-100 p-4">
                    <div class="flex flex-col sm:flex-row gap-2 sm:justify-end">
                        <div class="border-t border-gray-100 p-4">
                            <a href="{{ route('invoice.download', $item->id) }}"
                            class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                                Download Invoice
                            </a>
                        </div>

                        {{-- <button class="w-full sm:w-auto px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors">
                            Invoice
                        </button> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($riwayat->isEmpty())
        <div class="text-center py-12">
            <div class="bg-white rounded-lg shadow-sm p-8 max-w-md mx-auto">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada transaksi</h3>
                <p class="text-gray-600 mb-6 text-sm">Mulai berbelanja dan temukan produk menarik di toko kami.</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    Mulai Belanja
                </a>
            </div>
        </div>
        @endif

        <!-- Load More Button (opsional jika diperlukan) -->
        @if($riwayat->count() >= 10)
        <div class="text-center mt-8">
            <button class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 rounded-lg font-medium transition-colors shadow-sm">
                Muat Lebih Banyak
            </button>
        </div>
        @endif
    </div>
</div>

<style>
/* Utility class untuk text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth transitions */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-duration: 150ms;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Focus states for accessibility */
button:focus,
select:focus,
input:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .space-y-4 > * + * {
        margin-top: 1rem;
    }
}
</style>
@endsection
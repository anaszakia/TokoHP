@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Riwayat Transaksi</h1>
        </div>

        <!-- Simple Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                <input type="month" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Filter
                </button>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="space-y-4">
            <!-- Transaction Card 1 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-900">#ORD-2024-001</h3>
                        <p class="text-sm text-gray-500">15 Jan 2024, 14:30</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        Selesai
                    </span>
                </div>
                
                <div class="border-t pt-3">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://via.placeholder.com/50x50" alt="Product" class="w-12 h-12 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">iPhone 15 Pro Max</p>
                            <p class="text-xs text-gray-500">Natural Titanium • Qty: 1</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp 20.999.000</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-3 pt-3 border-t">
                    <p class="font-semibold text-gray-900">Total: Rp 20.999.000</p>
                    <div class="flex gap-2">
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Detail
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                            Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transaction Card 2 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-900">#ORD-2024-002</h3>
                        <p class="text-sm text-gray-500">12 Jan 2024, 09:15</p>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                        Dikirim
                    </span>
                </div>
                
                <div class="border-t pt-3 space-y-2">
                    <div class="flex items-center gap-3">
                        <img src="https://via.placeholder.com/50x50" alt="Product" class="w-12 h-12 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">MacBook Air M2</p>
                            <p class="text-xs text-gray-500">Silver • Qty: 1</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp 18.999.000</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://via.placeholder.com/50x50" alt="Product" class="w-12 h-12 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">Magic Mouse</p>
                            <p class="text-xs text-gray-500">White • Qty: 1</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp 1.299.000</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-3 pt-3 border-t">
                    <p class="font-semibold text-gray-900">Total: Rp 20.298.000</p>
                    <div class="flex gap-2">
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lacak
                        </button>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Transaction Card 3 -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-900">#ORD-2024-003</h3>
                        <p class="text-sm text-gray-500">10 Jan 2024, 16:45</p>
                    </div>
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                        Dibatalkan
                    </span>
                </div>
                
                <div class="border-t pt-3">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://via.placeholder.com/50x50" alt="Product" class="w-12 h-12 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">AirPods Pro</p>
                            <p class="text-xs text-gray-500">White • Qty: 1</p>
                        </div>
                        <p class="font-semibold text-gray-900">Rp 3.999.000</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-3 pt-3 border-t">
                    <p class="font-semibold text-gray-900">Total: Rp 3.999.000</p>
                    <div class="flex gap-2">
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Detail
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                            Beli Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Pagination -->
        <div class="flex justify-center mt-8">
            <div class="flex items-center gap-2">
                <button class="px-3 py-2 text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                    ←
                </button>
                <span class="px-3 py-2 bg-blue-600 text-white rounded">1</span>
                <button class="px-3 py-2 text-gray-700 hover:text-gray-900">2</button>
                <button class="px-3 py-2 text-gray-700 hover:text-gray-900">3</button>
                <button class="px-3 py-2 text-gray-500 hover:text-gray-700">
                    →
                </button>
            </div>
        </div>

        <!-- Empty State -->
        {{-- 
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h3>
            <p class="text-gray-500 mb-4">Mulai berbelanja untuk melihat riwayat transaksi.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Mulai Belanja
            </a>
        </div>
        --}}
    </div>
</div>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        // Contoh data dummy - ganti dengan data dari database
        $transactions = [
            [
                'id' => 1,
                'order_number' => 'ORD-2024-001',
                'date' => '2024-01-15 14:30:00',
                'total' => 750000,
                'status' => 'completed',
                'items_count' => 3,
                'items' => [
                    [
                        'name' => 'iPhone 15 Pro Max',
                        'variant' => 'Natural Titanium • 256GB',
                        'quantity' => 1,
                        'price' => 20999000,
                        'image' => 'https://via.placeholder.com/60x60'
                    ]
                ]
            ],
            [
                'id' => 2,
                'order_number' => 'ORD-2024-002',
                'date' => '2024-01-12 09:15:00',
                'total' => 1250000,
                'status' => 'shipped',
                'items_count' => 2,
                'items' => [
                    [
                        'name' => 'MacBook Air M2',
                        'variant' => 'Silver • 256GB SSD',
                        'quantity' => 1,
                        'price' => 18999000,
                        'image' => 'https://via.placeholder.com/60x60'
                    ],
                    [
                        'name' => 'Magic Mouse',
                        'variant' => 'White • Wireless',
                        'quantity' => 1,
                        'price' => 1299000,
                        'image' => 'https://via.placeholder.com/60x60'
                    ]
                ]
            ]
        ];

        return view('riwayat-transaksi', compact('transactions'));
    }

    public function show($id)
    {
        // Detail transaksi berdasarkan ID
        return view('riwayat-detail', compact('id'));
    }

    public function filter(Request $request)
    {
        // Logic untuk filter transaksi
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Query database berdasarkan filter
        // $transactions = Transaction::query()
        //     ->when($status, function($query) use ($status) {
        //         return $query->where('status', $status);
        //     })
        //     ->when($dateFrom, function($query) use ($dateFrom) {
        //         return $query->whereDate('created_at', '>=', $dateFrom);
        //     })
        //     ->when($dateTo, function($query) use ($dateTo) {
        //         return $query->whereDate('created_at', '<=', $dateTo);
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);

        return redirect()->back();
    }
}
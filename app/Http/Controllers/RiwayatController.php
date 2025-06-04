<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua transaksi milik user yang sedang login
        $riwayat = Transaksi::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('riwayat-transaksi', compact('riwayat'));
    }
}

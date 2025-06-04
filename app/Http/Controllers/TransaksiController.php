<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function invoice($id) 
    {
    $item = Transaksi::with(['user', 'produk.images'])->findOrFail($id);
    return view('invoice', compact('item'));
    }

}

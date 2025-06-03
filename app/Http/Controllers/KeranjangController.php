<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Menampilkan halaman keranjang
     */
    public function index()
    {
        $keranjangItems = Keranjang::with('produk.brand', 'produk.images')
            ->forUser(Auth::id())
            ->get();

        $total = $keranjangItems->sum('subtotal');

        return view('keranjang', compact('keranjangItems', 'total'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function tambah(Request $request, $produkId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $produk = Product::findOrFail($produkId);
        
        // Cek apakah produk sudah ada di keranjang
        $keranjangItem = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produkId)
            ->first();

        if ($keranjangItem) {
            // Jika sudah ada, tambah jumlahnya
            $keranjangItem->jumlah += $request->jumlah ?? 1;
            $keranjangItem->save();
        } else {
            // Jika belum ada, buat item baru
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produkId,
                'jumlah' => $request->jumlah ?? 1,
                'harga' => $produk->harga_sekarang
            ]);
        }

        // Hitung total item di keranjang
        $totalItems = Keranjang::forUser(Auth::id())->sum('jumlah');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'totalItems' => $totalItems
        ]);
    }

    /**
     * Mengupdate jumlah produk di keranjang
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjangItem = Keranjang::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $keranjangItem->jumlah = $request->jumlah;
        $keranjangItem->save();

        // Hitung ulang total
        $keranjangItems = Keranjang::forUser(Auth::id())->get();
        $total = $keranjangItems->sum('subtotal');
        $totalItems = $keranjangItems->sum('jumlah');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui',
            'subtotal' => number_format($keranjangItem->subtotal, 0, ',', '.'),
            'total' => number_format($total, 0, ',', '.'),
            'totalItems' => $totalItems
        ]);
    }

    /**
     * Menghapus produk dari keranjang
     */
    public function hapus($id)
    {
        $keranjangItem = Keranjang::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $keranjangItem->delete();

        // Hitung ulang total
        $keranjangItems = Keranjang::forUser(Auth::id())->get();
        $total = $keranjangItems->sum('subtotal');
        $totalItems = $keranjangItems->sum('jumlah');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang',
            'total' => number_format($total, 0, ',', '.'),
            'totalItems' => $totalItems
        ]);
    }

    /**
     * Mengosongkan keranjang
     */
    public function kosongkan()
    {
        Keranjang::forUser(Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    /**
     * Mendapatkan jumlah item di keranjang (untuk navbar)
     */
    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Keranjang::forUser(Auth::id())->sum('jumlah');
        
        return response()->json(['count' => $count]);
    }
}
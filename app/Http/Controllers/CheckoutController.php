<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class CheckoutController extends Controller
{
    public function pay(Request $request)
    {
        try {
            // Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $user = Auth::user();
            $keranjang = Keranjang::where('user_id', $user->id)->with('produk')->get();
            
            if ($keranjang->isEmpty()) {
                return response()->json(['error' => 'Keranjang kosong'], 400);
            }
            
            $ongkir = 30000;
            $subtotal = 0;

            $items = [];
            foreach ($keranjang as $item) {
                $harga = $item->produk->harga_sekarang;
                $qty = $item->jumlah;
                $total = $harga * $qty;
                $subtotal += $total;

                $items[] = [
                    'id' => (string)$item->produk_id,
                    'price' => (int)$harga,
                    'quantity' => (int)$qty,
                    'name' => $item->produk->nama,
                ];
            }

            $totalBayar = $subtotal + $ongkir;

            // Tambahkan ongkir sebagai item
            $items[] = [
                'id' => 'ONGKIR',
                'price' => (int)$ongkir,
                'quantity' => 1,
                'name' => 'Ongkos Kirim'
            ];

            // Generate order_id sekali untuk semua item transaksi
            $order_id = 'ORDER-' . time() . '-' . $user->id;

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => (int)$totalBayar,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'item_details' => $items,
            ];

            $snapToken = Snap::getSnapToken($params);

            // Log untuk debugging
            Log::info('Checkout Pay Success', [
                'order_id' => $order_id,
                'user_id' => $user->id,
                'total' => $totalBayar
            ]);

            // Kirim snap_token dan order_id ke frontend
            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $order_id,
            ]);
            
        } catch (Exception $e) {
            Log::error('Checkout Pay Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memproses pembayaran'], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'order_id' => 'required|string',
                'transaction_status' => 'string',
            ]);

            $user = Auth::user();

            // Pastikan data order_id dan transaction_status dari frontend
            $order_id = $request->order_id;
            $midtrans_status = $request->transaction_status ?? 'settlement';
            
            // Map Midtrans status ke status internal (sesuai ENUM database)
            $status_mapping = [
                'capture' => 'sukses',
                'settlement' => 'sukses', 
                'pending' => 'menunggu',
                'deny' => 'menunggu',
                'cancel' => 'menunggu',
                'expire' => 'menunggu',
                'failure' => 'menunggu'
            ];
            
            $transaction_status = $status_mapping[$midtrans_status] ?? 'menunggu';

            Log::info('Checkout Success Request', [
                'order_id' => $order_id,
                'user_id' => $user->id,
                'midtrans_status' => $midtrans_status,
                'mapped_status' => $transaction_status
            ]);

            // Cek apakah transaksi sudah ada
            $existingTransaction = Transaksi::where('order_id', $order_id)->first();
            if ($existingTransaction) {
                return response()->json(['message' => 'Transaksi sudah disimpan sebelumnya']);
            }

            $keranjang = Keranjang::where('user_id', $user->id)->with('produk')->get();
            
            if ($keranjang->isEmpty()) {
                return response()->json(['error' => 'Keranjang kosong'], 400);
            }
            
            $ongkir = 30000;
            $subtotal = 0;
            
            foreach ($keranjang as $item) {
                $subtotal += $item->produk->harga_sekarang * $item->jumlah;
            }

            $totalBayar = $subtotal + $ongkir;

            // Hitung ongkir per item (dibagi rata)
            $ongkirPerItem = $ongkir / $keranjang->count();

            // Simpan tiap produk sebagai transaksi terpisah dengan order_id sama
            foreach ($keranjang as $item) {
                $qty = $item->jumlah;
                $harga = $item->produk->harga_sekarang;
                $total_item = ($harga * $qty) + $ongkirPerItem;

                $transaksi = Transaksi::create([
                    'order_id' => $order_id,
                    'user_id' => $user->id,
                    'produk_id' => $item->produk_id,
                    'qty' => $qty,
                    'ongkir' => $ongkirPerItem,
                    'total_bayar' => $total_item,
                    'status' => $transaction_status,
                ]);

                Log::info('Transaction Created', [
                    'transaksi_id' => $transaksi->id,
                    'order_id' => $order_id,
                    'produk_id' => $item->produk_id
                ]);
            }

            // Kosongkan keranjang
            Keranjang::where('user_id', $user->id)->delete();

            Log::info('Checkout Success Completed', ['order_id' => $order_id]);

            return response()->json(['message' => 'Transaksi berhasil disimpan']);
            
        } catch (Exception $e) {
            Log::error('Checkout Success Error: ' . $e->getMessage(), [
                'order_id' => $request->order_id ?? 'unknown',
                'user_id' => Auth::id()
            ]);
            
            return response()->json(['error' => 'Gagal menyimpan transaksi'], 500);
        }
    }
}
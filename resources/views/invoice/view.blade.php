<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $item->order_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header - Simplified for PDF */
        .invoice-header {
            background: #1e40af;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .invoice-subtitle {
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .company-website {
            font-size: 12px;
        }
        
        /* Invoice Details - Table Layout */
        .invoice-details {
            margin-bottom: 40px;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .details-table td {
            padding: 10px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }
        
        .details-table .section-header {
            background: #f9fafb;
            font-weight: bold;
            color: #374151;
            text-align: center;
        }
        
        .detail-label {
            color: #6b7280;
            font-weight: 500;
            width: 30%;
        }
        
        .detail-value {
            font-weight: 600;
            color: #1f2937;
            width: 70%;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border: 1px solid #ccc;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-success {
            background: #dcfce7;
            color: #166534;
            border-color: #166534;
        }
        
        .status-info {
            background: #dbeafe;
            color: #1d4ed8;
            border-color: #1d4ed8;
        }
        
        /* Product Table */
        .product-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 5px;
        }
        
        .product-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
        }
        
        .table-header {
            background: #f9fafb;
            font-weight: bold;
            color: #374151;
        }
        
        .table-header th {
            padding: 15px 12px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #e5e7eb;
        }
        
        .table-row td {
            padding: 20px 12px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }
        
        .product-info {
            width: 100%;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            float: left;
            margin-right: 15px;
        }
        
        .product-details h3 {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.3;
        }
        
        .product-specs {
            margin-top: 8px;
        }
        
        .spec-tag {
            display: inline-block;
            padding: 3px 8px;
            margin-right: 6px;
            border: 1px solid #ccc;
            font-size: 10px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .spec-gray {
            background: #f3f4f6;
            color: #4b5563;
            border-color: #4b5563;
        }
        
        .spec-blue {
            background: #dbeafe;
            color: #1d4ed8;
            border-color: #1d4ed8;
        }
        
        .spec-purple {
            background: #e9d5ff;
            color: #7c3aed;
            border-color: #7c3aed;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .font-medium {
            font-weight: 500;
        }
        
        .font-bold {
            font-weight: bold;
        }
        
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        
        /* Payment Summary */
        .payment-summary {
            background: #f9fafb;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
        }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-table td {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .summary-table .summary-total td {
            border-top: 2px solid #d1d5db;
            padding-top: 15px;
            margin-top: 15px;
            font-weight: bold;
        }
        
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #1d4ed8;
        }
        
        /* Footer */
        .invoice-footer {
            padding-top: 30px;
            border-top: 2px solid #e5e7eb;
        }
        
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .footer-table td {
            padding: 15px;
            vertical-align: top;
            width: 50%;
        }
        
        .footer-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        
        .footer-content {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.5;
        }
        
        .footer-note {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #9ca3af;
        }
        
        /* Print Optimization */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            .invoice-container {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-subtitle">Bukti Pembayaran Resmi</div>
            <div class="company-name">{{ config('app.name', 'Toko Online') }}</div>
            <div class="company-website">www.tokoonline.com</div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <table class="details-table">
                <tr>
                    <td class="section-header" colspan="2">Detail Invoice</td>
                    <td class="section-header" colspan="2">Informasi Pembeli</td>
                </tr>
                <tr>
                    <td class="detail-label">Nomor Invoice:</td>
                    <td class="detail-value">#{{ $item->order_id }}</td>
                    <td class="detail-label">Nama:</td>
                    <td class="detail-value">{{ $item->user->name ?? 'Customer' }}</td>
                </tr>
                <tr>
                    <td class="detail-label">Tanggal Transaksi:</td>
                    <td class="detail-value">{{ date('d F Y', strtotime($item->created_at)) }}</td>
                    <td class="detail-label">Email:</td>
                    <td class="detail-value">{{ $item->user->email ?? 'customer@example.com' }}</td>
                </tr>
                <tr>
                    <td class="detail-label">Status Pembayaran:</td>
                    <td class="detail-value">
                        <span class="status-badge status-success">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td class="detail-label">No. Telepon:</td>
                    <td class="detail-value">{{ $item->user->no_hp ?? '+62 812-3456-7890' }}</td>
                </tr>
                <tr>
                    <td class="detail-label">Status Pengiriman:</td>
                    <td class="detail-value">
                        <span class="status-badge status-info">{{ ucfirst($item->status_pengiriman) }}</span>
                    </td>
                    <td class="detail-label">Alamat:</td>
                    <td class="detail-value">{{ $item->user->alamat_lengkap ?? 'Jl. Contoh Alamat No. 123, Kota Contoh, Provinsi 12345' }}</td>
                </tr>
                @if($item->resi)
                <tr>
                    <td class="detail-label">Nomor Resi:</td>
                    <td class="detail-value">{{ $item->resi }}</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Product Details -->
        <div class="product-section">
            <div class="section-title">Detail Produk</div>
            <table class="product-table">
                <thead class="table-header">
                    <tr>
                        <th style="width: 50%;">Produk</th>
                        <th style="width: 10%;" class="text-center">Qty</th>
                        <th style="width: 20%;" class="text-right">Harga Satuan</th>
                        <th style="width: 20%;" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td>
                            <div class="product-info clearfix">
                                <img src="{{ public_path('storage/' . ($item->produk->images->first()->image_path ?? 'placeholder.jpg')) }}" 
                                     alt="{{ $item->produk->nama }}" 
                                     class="product-image"
                                     onerror="this.style.display='none'">
                                <div class="product-details">
                                    <h3>{{ $item->produk->nama ?? 'Produk tidak ditemukan' }}</h3>
                                    <div class="product-specs">
                                        @if($item->produk->warna)
                                        <span class="spec-tag spec-gray">{{ $item->produk->warna }}</span>
                                        @endif
                                        @if($item->produk->rom)
                                        <span class="spec-tag spec-blue">{{ $item->produk->rom }}</span>
                                        @endif
                                        @if($item->produk->sistem_operasi)
                                        <span class="spec-tag spec-purple">{{ $item->produk->sistem_operasi }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center font-medium">{{ $item->qty }}</td>
                        <td class="text-right font-medium">
                             Rp {{ number_format($item->produk->harga_sekarang ?? 0, 0, ',', '.') }}
                        </td>
                       <td class="text-right font-bold">
                            Rp {{ number_format(($item->produk->harga_sekarang ?? 0) * $item->qty, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Summary -->
        <div class="payment-summary">
            <div class="section-title">Ringkasan Pembayaran</div>
            <table class="summary-table">
                <tr>
                    <td>Biaya Pengiriman:</td>
                    <td class="text-right font-medium">Rp {{ number_format($item->ongkir ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Biaya Admin:</td>
                    <td class="text-right font-medium">Rp 0</td>
                </tr>
                <tr class="summary-total">
                    <td>Total Pembayaran:</td>
                    <td class="text-right total-amount">Rp {{ number_format($item->total_bayar ?? 0, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <table class="footer-table">
                <tr>
                    <td>
                        <div class="footer-title">Informasi Toko</div>
                        <div class="footer-content">
                            <div>{{ config('app.name', 'Toko Online') }}</div>
                            <div>Jl. Toko Online No. 123, Jakarta 12345</div>
                            <div>Telp: +62 21 1234 5678</div>
                            <div>Email: info@tokoonline.com</div>
                        </div>
                    </td>
                    <td>
                        <div class="footer-title">Catatan</div>
                        <div class="footer-content">
                            Invoice ini merupakan bukti pembayaran yang sah. 
                            Simpan dengan baik sebagai dokumentasi transaksi Anda.
                            Untuk pertanyaan lebih lanjut, hubungi customer service kami.
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="footer-note">
            Invoice dibuat secara otomatis pada {{ date('d F Y H:i:s') }} WIB
        </div>
    </div>
</body>
</html>
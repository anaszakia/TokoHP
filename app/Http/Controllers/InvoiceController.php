<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download($id)
    {
        $item = Transaksi::findOrFail($id);
    
        // Set options untuk DomPDF
        $pdf = Pdf::loadView('invoice.view', compact('item'))
                ->setPaper('A4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true,
                    'defaultFont' => 'Arial',
                    'isFontSubsettingEnabled' => true,
                    'isRemoteEnabled' => true, // Untuk mengakses gambar
                    'debugCss' => false,
                    'debugKeepTemp' => false,
                    'debugPng' => false,
                    'defaultPaperSize' => 'A4',
                    'dpi' => 150,
                    'fontHeightRatio' => 1.1
                ]);
        
        return $pdf->download('invoice-'.$item->order_id.'.pdf');
    }
}

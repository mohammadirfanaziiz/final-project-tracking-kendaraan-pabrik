<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Mpdf\Mpdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal mulai dan tanggal akhir dari request
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        // Ambil pengiriman yang statusnya "OTW" atau sudah selesai
        $pengiriman = Pengiriman::whereBetween('created_at', [$startDate, $endDate])
            ->where(function($query) {
                $query->whereNotNull('kedatangan_sebenarnya')  // Mengambil yang sudah kedatangan
                      ->orWhere('status', 'OTW');  // Mengambil yang masih OTW
            })
            ->get();

        // Hitung statistik
        $tepatWaktu = $pengiriman->filter(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->lessThanOrEqualTo(Carbon::parse($item->estimasi_kedatangan));
        })->count();

        $terlambat = $pengiriman->filter(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->gt(Carbon::parse($item->estimasi_kedatangan));
        })->count();

        $rataWaktuPengiriman = $pengiriman->avg(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->diffInMinutes(Carbon::parse($item->estimasi_kedatangan));
        });

        return view('laporan.index', compact('tepatWaktu', 'terlambat', 'rataWaktuPengiriman', 'pengiriman', 'startDate', 'endDate'));
    }

    // Fungsi untuk export data ke file PDF

    public function exportToPDF(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $pengiriman = Pengiriman::whereNotNull('kedatangan_sebenarnya')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $tepatWaktu = $pengiriman->filter(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->lessThanOrEqualTo(Carbon::parse($item->estimasi_kedatangan));
        })->count();

        $terlambat = $pengiriman->filter(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->gt(Carbon::parse($item->estimasi_kedatangan));
        })->count();

        $rataWaktuPengiriman = $pengiriman->avg(function($item) {
            return Carbon::parse($item->kedatangan_sebenarnya)->diffInMinutes(Carbon::parse($item->estimasi_kedatangan));
        });

        // Buat PDF menggunakan mPDF
        $mpdf = new \Mpdf\Mpdf();
        $html = view('laporan.pdf', compact('tepatWaktu', 'terlambat', 'rataWaktuPengiriman', 'pengiriman', 'startDate', 'endDate'))->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('laporan_pengiriman.pdf', 'D');
    }

}

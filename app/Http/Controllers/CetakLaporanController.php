<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \PDF;

class CetakLaporanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->get('bulanIni') == 'true') {
            $riwayat_peminjaman = Peminjaman::with('user', 'buku')->whereMonth('created_at', date('m'))->get();
            $bulan              = \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM');
            $tahun              = \Carbon\Carbon::now()->locale('id')->isoFormat('YYYY');
            $pdf                = PDF::loadView(
                'peminjaman.laporan_pdf',
                [
                    'peminjaman' => $riwayat_peminjaman,
                    'bulan' => $bulan,
                    'tahun' => $tahun
                ]
            );
            return $pdf->download('laporan_peminjaman.pdf');
            // dd($riwayat_peminjaman);
        }
        $peminjaman = Peminjaman::with('user', 'buku')->get();

        $pdf = PDF::loadView('peminjaman.laporan_pdf', ['peminjaman' => $peminjaman]);

        return $pdf->download('laporan_peminjaman.pdf');
    }
}
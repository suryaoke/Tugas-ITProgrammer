<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    /**
     * 1. Tampilkan data pelanggan yang mempunyai kelamin perempuan,
     * umur antara 19 sampai 30, dan pemeriksaan pada bulan Agustus 2015.
     */
    public function query1()
    {
        $pelanggan = DB::table('pelanggans')
            ->join('transaksis', 'pelanggans.id', '=', 'transaksis.pelanggan_id')
            ->where('pelanggans.jenis_kelamin', 'Perempuan')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [19, 30])
            ->whereYear('transaksis.tanggal_pemeriksaan', 2015)
            ->whereMonth('transaksis.tanggal_pemeriksaan', 8)
            ->select('pelanggans.*', 'transaksis.tanggal_pemeriksaan')
            ->get();

        return response()->json($pelanggan);
    }

    /**
     * 2. Tampilkan data semua dokter yang mempunyai transaksi dengan pasien
     * ataupun tidak selama setahun di 2015.
     */
    public function query2()
    {
        $dokter = DB::table('dokters')
            ->leftJoin('transaksis', 'dokters.id', '=', 'transaksis.dokter_id')
            ->select('dokters.id', 'dokters.nama')
            ->where(function ($query) {
                $query->whereNull('transaksis.id')
                    ->orWhereYear('transaksis.tanggal_pemeriksaan', 2015);
            })
            ->distinct()
            ->get();

        return response()->json($dokter);
    }

    /**
     * 3. Hitung jumlah obat dan total uang per-obat selama bulan Agustus sampai Desember 2015.
     */
    public function query3()
    {
        $obat = DB::table('detail_transaksis')
            ->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->join('obats', 'detail_transaksis.obat_id', '=', 'obats.id')
            ->select(
                'obats.nama_obat',
                DB::raw('SUM(detail_transaksis.jumlah) AS total_jumlah'),
                DB::raw('SUM(detail_transaksis.jumlah * obats.harga) AS total_uang')
            )
            ->whereBetween('transaksis.tanggal_pemeriksaan', ['2015-08-01', '2015-12-31'])
            ->groupBy('obats.id', 'obats.nama_obat')
            ->get();

        return response()->json($obat);
    }



    /**
     * 4. Tampilkan 10 jenis obat yang paling banyak digunakan selama tahun 2015.
     */
    public function query4()
    {
        $obatTerbanyak = DB::table('detail_transaksis')
            ->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->join('obats', 'detail_transaksis.obat_id', '=', 'obats.id')
            ->select('obats.nama_obat', DB::raw('SUM(detail_transaksis.jumlah) AS total_jumlah'))
            ->whereYear('transaksis.tanggal_pemeriksaan', 2015)
            ->groupBy('obats.id', 'obats.nama_obat')
            ->orderByDesc('total_jumlah')
            ->limit(10)
            ->get();

        return response()->json($obatTerbanyak);
    }


    /**
     * 5. Tampilkan data pelanggan dengan kategori umur:
     *    - "Anak-anak" (< 18 tahun)
     *    - "Dewasa" (18 - 30 tahun)
     *    - "Orang tua" (> 30 tahun)
     */
    public function query5()
    {
        $pelanggan = DB::table('pelanggans')
            ->select(
                'id',
                'nama',
                'jenis_kelamin',
                DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) as umur'),
                DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 18 THEN 'Anak-anak'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 30 THEN 'Dewasa'
                    ELSE 'Orang tua'
                END AS kategori_umur
            ")
            )
            ->get();

        return response()->json($pelanggan);
    }
}

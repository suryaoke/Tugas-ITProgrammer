Halaman Detail Pemeriksaan

![alt text](https://github.com/suryaoke/Tugas-ITProgrammer/blob/main/studi-kasus/detail%20pemeriksaan.jpg?raw=true)

Halaman Pemeriksaan

![alt text](https://github.com/suryaoke/Tugas-ITProgrammer/blob/main/studi-kasus/pemeriksaan.jpg?raw=true)


Halaman Create Pemeriksaan

![alt text](https://github.com/suryaoke/Tugas-ITProgrammer/blob/main/studi-kasus/create%20pemeriksaan.jpg?raw=true)

 Soal Query 

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

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

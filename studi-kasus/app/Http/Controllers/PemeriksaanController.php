<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiStoreRequest;
use App\Models\DetailTransaksi;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $transaksis = Transaksi::paginate(10);
        return view('admin.pemeriksaan.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pelangganOptions = Pelanggan::pluck('nama', 'id')->toArray();
        $dokterOptions = Dokter::pluck('nama', 'id')->toArray();
        $obatOptions = Obat::pluck('nama_obat', 'id')->toArray();

        return view('admin.pemeriksaan.create', compact('pelangganOptions', 'dokterOptions', 'obatOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiStoreRequest $request): RedirectResponse
    {
        // Simpan data transaksi utama ke database
        $transaksi = new Transaksi();
        $transaksi->pelanggan_id = $request->pelanggan_id;
        $transaksi->dokter_id = $request->dokter_id;
        $transaksi->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;
        $transaksi->total_biaya = $request->total_biaya;
        $transaksi->save();

        // Ambil data detail transaksi dari cache
        $cachedDetails = Cache::get('transaksi_details', []);

        // Simpan setiap detail transaksi ke database
        foreach ($cachedDetails as $detail) {
            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->obat_id = $detail['obat_id'];
            $detailTransaksi->jumlah = $detail['jumlah'];

            // Ambil data obat dari tabel obat untuk mendapatkan harga
            $obat = Obat::find($detail['obat_id']);
            if ($obat) {
                // Hitung subtotal = jumlah x harga obat
                $detailTransaksi->subtotal = $detail['jumlah'] * $obat->harga;
            } else {
                $detailTransaksi->subtotal = 0;
            }
            $detailTransaksi->save();
        }

        // Hapus data detail transaksi dari cache setelah selesai disimpan
        Cache::forget('transaksi_details');

        notyf()->success("Created Successfully!");

        return to_route('admin.pemeriksaan.index');
    }



    public function storeDetail(Request $request)
    {
        $request->validate([
            'obat_id' => 'required',
            'jumlah'  => 'required|integer|min:1'
        ]);

        // Ambil detail transaksi yang sudah ada di cache
        $cachedDetails = Cache::get('transaksi_details', []);

        // Tambahkan detail transaksi baru ke dalam array
        $cachedDetails[] = [
            'obat_id' => $request->obat_id,
            'jumlah'  => $request->jumlah,
        ];

        // Simpan kembali ke cache dengan masa berlaku 10 menit
        Cache::put('transaksi_details', $cachedDetails, now()->addMinutes(10));

        notyf()->success("Detail Transaksi Berhasil Ditambahkan!");

        // Redirect kembali ke halaman form utama
        return to_route('admin.pemeriksaan.create');
    }

    public function deleteDetail($index)
    {
        // Ambil data detail dari cache
        $cachedDetails = Cache::get('transaksi_details', []);

        // Cek apakah index tersebut ada di dalam array cache
        if (isset($cachedDetails[$index])) {
            unset($cachedDetails[$index]);
            // Re-index array agar index kembali berurutan
            $cachedDetails = array_values($cachedDetails);

            // Simpan kembali data yang telah diupdate ke cache
            Cache::put('transaksi_details', $cachedDetails, now()->addMinutes(10));

            notyf()->success("Detail transaksi berhasil dihapus!");
        } else {
            notyf()->error("Detail transaksi tidak ditemukan!");
        }

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {}

    /**
     * Update the specified resource in storage.
     */
    public function update() {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $pemeriksaan)
    {
        try {
            // Hapus detail transaksi terkait terlebih dahulu
            $pemeriksaan->detailTransaksis()->delete();

            // Hapus transaksi utama
            $pemeriksaan->delete();

            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("Transaksi Error: " . $e->getMessage());
            return response(['message' => 'Something went wrong!'], 500);
        }
    }

    public function detail(Transaksi $pemeriksaan)
    {
        $detailTransaksis = DetailTransaksi::where('transaksi_id', $pemeriksaan->id)->paginate(10);
        return view('admin.pemeriksaan.detail', compact('pemeriksaan', 'detailTransaksis'));
    }
}

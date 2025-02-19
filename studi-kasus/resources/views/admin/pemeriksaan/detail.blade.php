@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <h3 class="card-title"> {{ $pemeriksaan->dokter->nama }} </h3>
                        -----------------------------------------
                        <p class=""> No.Telepon : {{ $pemeriksaan->dokter->no_telepon }} </p>
                    </div>


                    <div class="card-actions">
                        <p class="card-title"> Nota Biaya Periksa / Obat / Tindakan</p>
                        <p class=""> No. {{ $pemeriksaan->id }} </p>
                    </div>
                </div>

                <div class="card-header">
                    <div class="">
                        <p class="">Pasien : {{ $pemeriksaan->pelanggan->nama }} </p>
                        <p class="">Alamat : {{ $pemeriksaan->pelanggan->alamat }} </p>
                        <p class="">Penanggung : </p>

                    </div>


                    <div class="card-actions">
                        <p class="">Kelamin : {{ $pemeriksaan->pelanggan->jenis_kelamin }} </p>
                        <p class="">Umur: {{ \Carbon\Carbon::parse($pemeriksaan->pelanggan->tanggal_lahir)->age }}
                            tahun</p>

                        <p class="">Tanggal : {{ $pemeriksaan->tanggal_pemeriksaan }} </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Hrg./Tarif Sat</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PEMERIKSAAN</td>
                                    <td>{{ $pemeriksaan->total_biaya }}</td>
                                    <td>1</td>
                                    <td>{{ $pemeriksaan->total_biaya }}</td>
                                </tr>
                                @forelse ($detailTransaksis as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration + 1 }}</td>
                                        <td>{{ $transaksi->obat->nama_obat }}</td>
                                        <td>{{ $transaksi->obat->harga }}</td>
                                        <td>{{ $transaksi->jumlah }}</td>
                                        <td>{{ $transaksi->subtotal }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse

                                <tr>
                                    <td></td>
                                    <td>Pasien</td>
                                    <td>Dokter</td>
                                    <td>Total:</td>
                                    <td>{{ $pemeriksaan->total_biaya + $detailTransaksis->sum('subtotal') }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>---------</td>
                                    <td>---------</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $detailTransaksis->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

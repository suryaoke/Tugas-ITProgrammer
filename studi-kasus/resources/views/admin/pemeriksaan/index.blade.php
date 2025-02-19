@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pemeriksaan</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.pemeriksaan.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i>
                            Add new
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pelanggan</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Pemeriksaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as  $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->pelanggan->nama }}</td>
                                        <td>{{ $transaksi->dokter->nama }}</td>
                                        <td>{{ $transaksi->tanggal_pemeriksaan }}</td>
                                        <td>
                                            <a href="{{ route('admin.pemeriksaan.detail', $transaksi->id) }}"
                                                class="btn-sm btn-warning text-warning">
                                                <i class="ti ti-list"></i>
                                            </a>


                                            <a href="{{ route('admin.pemeriksaan.destroy', $transaksi->id) }}"
                                                class="text-red delete-item">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $transaksis->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

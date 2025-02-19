@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Pemeriksaan</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.pemeriksaan.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pemeriksaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-capitalize">Pelanggan</label>
                                <x-select-block name="pelanggan_id" placeholder="Select Pelanggan" :value="old('pelanggan_id')"
                                    :options="$pelangganOptions" />

                                <x-input-error :messages="$errors->get('user')" class="mt-2" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-capitalize">Dokter</label>
                                <x-select-block name="dokter_id" placeholder="Select Dokter" :value="old('dokter_id')"
                                    :options="$dokterOptions" />

                                <x-input-error :messages="$errors->get('user')" class="mt-2" />
                            </div>
                            <div class="col-md-12">
                                <x-date name="tanggal_pemeriksaan" label="Tanggal Pemeriksaan" placeholder="Pilih Tanggal"
                                    value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}" />

                            </div>
                            <div class="col-md-12">
                                <x-input-block name="total_biaya" label="Biaya Pemeriksaan" placeholder="Enter harga" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-capitalize">Obat</label>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-report" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>

                            <table class="table table-vcenter card-table mb-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cachedDetails = Cache::get('transaksi_details', []);
                                    @endphp

                                    @if (count($cachedDetails) > 0)
                                        @foreach ($cachedDetails as $index => $detail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $obatOptions[$detail['obat_id']] ?? 'Unknown' }}</td>
                                                <td>{{ $detail['jumlah'] }}</td>
                                                <td>
                                                    <a href="{{ route('admin.pemeriksaan.deleteDetail', $index) }}"
                                                        class="text-red">
                                                        <i class="ti ti-trash-x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada detail transaksi</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary mt-3" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.pemeriksaan.storeDetail') }}" autocomplete="off" novalidate>
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-capitalize">Dokter</label>
                            <x-select-block name="obat_id" placeholder="Select Obat" :value="old('obat_id')" :options="$obatOptions" />

                        </div>
                        <div class="mb-3">
                            <x-input-block name="jumlah" label="Jumlah" placeholder="Enter Jumlah" />
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <i class="ti ti-device-floppy"></i>
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

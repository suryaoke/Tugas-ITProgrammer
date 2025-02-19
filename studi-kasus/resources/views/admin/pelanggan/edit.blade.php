@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Pelanggan</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <x-input-block name="nama" :value="$pelanggan->nama" placeholder="Enter nama pelanggan"
                                    label="Nama Pelanggan" />
                            </div>

                            <!-- Radio Jenis Kelamin -->
                            <div class="col-md-12">
                                           <x-inline-radios
                                    name="jenis_kelamin"
                                    label="Jenis Kelamin"
                                    :options="[
                                        [
                                            'value'   => 'Laki-laki',
                                            'label'   => 'Laki-laki',
                                            'checked' => $pelanggan->jenis_kelamin === 'Laki-laki'
                                        ],
                                        [
                                            'value'   => 'Perempuan',
                                            'label'   => 'Perempuan',
                                            'checked' => $pelanggan->jenis_kelamin === 'Perempuan'
                                        ],
                                    ]"
                                />
                            </div>

                            <!-- Input Tanggal Lahir -->
                            <div class="col-md-12">
                                <x-date name="tanggal_lahir" label="Tanggal Lahir" placeholder="Pilih Tanggal Lahir"
                                    :value="old(
                                        'tanggal_lahir',
                                        $pelanggan->tanggal_lahir
                                            ? \Illuminate\Support\Carbon::parse($pelanggan->tanggal_lahir)->format(
                                                'Y-m-d',
                                            )
                                            : date('Y-m-d'),
                                    )" />
                            </div>

                            <!-- Input Nomor Telepon -->
                            <div class="col-md-12">
                                <x-input-block name="no_telepon" :value="$pelanggan->no_telepon" placeholder="Enter nomor telepon"
                                    label="Nomor Telepon" />
                            </div>

                            <!-- Input Alamat -->
                            <div class="col-md-12">
                                <x-input-text name="alamat" :value="$pelanggan->alamat" placeholder="Enter Alamat" label="Alamat" />
                            </div>

                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

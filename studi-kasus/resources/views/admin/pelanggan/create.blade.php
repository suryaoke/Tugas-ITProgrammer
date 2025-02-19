@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create pelanggan</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <x-input-block name="nama" placeholder="Enter nama pelanggan" />
                            </div>
                            <div class="col-md-12">
                                <x-inline-radios name="jenis_kelamin" label="Jenis Kelamin" :options="[
                                    ['value' => 'Laki-laki', 'label' => 'Laki-laki'],
                                    ['value' => 'Perempuan', 'label' => 'Perempuan'],
                                ]" />
                            </div>
                            <div class="col-md-12">
                                <x-date name="tanggal_lahir" label="Tanggal Lahir" placeholder="Pilih Tanggal Lahir"
                                    value="{{ old('tanggal_lahir', date('Y-m-d')) }}" />

                            </div>
                            <div class="col-md-12">
                                <x-input-block name="no_telepon" placeholder="Enter nama pelanggan" />
                            </div>
                            <div class="col-md-12">
                                <x-input-text name="alamat" placeholder="Enter Alamat" />
                            </div>

                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

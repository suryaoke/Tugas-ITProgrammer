@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Obat</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.obat.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <x-input-block name="nama_obat" :value="$obat->nama_obat" placeholder="Enter nama obat"
                                    label="Nama obat" />
                            </div>

                            <div class="col-md-12">
                                <x-input-block name="harga" :value="$obat->harga" placeholder="Enter nama obat"
                                    label="Harga" />
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

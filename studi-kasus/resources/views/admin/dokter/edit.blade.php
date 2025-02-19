@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Dokter</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <x-input-block name="nama" :value="$dokter->nama" placeholder="Enter nama "
                                    label="Nama dokter" />
                            </div>

                            <div class="col-md-12">
                                <x-input-block name="spesialisasi" :value="$dokter->spesialisasi" placeholder="Enter spesialisasi "
                                    label="spesialisasi" />
                            </div>

                            <div class="col-md-12">
                                <x-input-block name="no_telepon" :value="$dokter->no_telepon" placeholder="Enter no_telepon "
                                    label="No Telepon" />
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

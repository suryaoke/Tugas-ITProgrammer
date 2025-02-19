@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create dokter</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <x-input-block name="nama" placeholder="Enter nama dokter" />
                            </div>
                            <div class="col-md-12">
                                <x-input-block name="spesialisasi" placeholder="Enter spesialisasi" />
                            </div>
                            <div class="col-md-12">
                                <x-input-block name="no_telepon" placeholder="Enter no telepon" />
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

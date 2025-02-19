@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">dokters</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
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
                                    <th>Nama</th>
                                    <th>Spesialisasi</th>
                                    <th>No telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokters as  $dokter)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dokter->nama }}</td>
                                        <td>{{ $dokter->spesialisasi }}</td>
                                        <td>{{ $dokter->no_telepon }}</td>


                                        <td>
                                          
                                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}"
                                                class="btn-sm btn-primary">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.dokter.destroy', $dokter->id) }}"
                                                class="text-red delete-item">
                                                <i class="ti ti-trash-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="55" class="text-center">No Data Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $dokters->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

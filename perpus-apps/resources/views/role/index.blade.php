@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{-- Alert Flash Message --}}
                    @if (session('success'))
                        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h3 class="card-title">{{ $thirdtitle ?? 'Data Role' }}</h3>
                    <div align="right">
                        <a href="{{ route('role.create') }}" class="btn btn-primary mt-2 mb-2">
                            <i class="bi bi-plus"></i> Tambah
                        </a>
                    </div>

                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $index => $val)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('role.edit', $val->id) }}" class="btn btn-sm btn-success me-1">
                                            Edit
                                        </a>
                                        <form action="{{ route('role.destroy', $val->id) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

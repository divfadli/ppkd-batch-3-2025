@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                {{-- Alert Flash Message --}}
                @if(session('success'))
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

                <div class="card-title d-flex justify-content-between align-items-center mb-3">
                    <h3>{{ $thirdtitle ?? 'Data' }}</h3>
                    <div>
                        <a href="" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i> Restore
                        </a>
                        <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Tambah
                        </a>
                    </div>
                </div>

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Lokasi</th>
                            <th>Label</th>
                            <th>Rak</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $val)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $val->code_location }}</td>
                            <td>{{ $val->label }}</td>
                            <td>{{ $val->bookshelf }}</td>
                            <td class="text-center">
                                <a href="{{ route('lokasi.edit', $val->id) }}" class="btn btn-sm btn-success me-1">
                                    Edit
                                </a>
                                <form action="{{ route('lokasi.destroy',$val->id) }}" method="post" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus lokasi buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
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
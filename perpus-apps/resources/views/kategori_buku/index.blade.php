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
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Tambah
                        </a>
                    </div>
                </div>

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori Buku</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $val)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $val->name_category }}</td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $val->id) }}" class="btn btn-sm btn-success me-1">
                                    Edit
                                </a>
                                <form action="{{ route('kategori.destroy',$val->id) }}" method="post" class="d-inline"
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
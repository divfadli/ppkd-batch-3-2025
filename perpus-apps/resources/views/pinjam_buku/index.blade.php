@extends('app')
@section('content')
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

            <h3 class="card-title">{{ $thirdtitle ?? '' }}</h3>
            <div align='right' class="mb-3">
                <a href="{{ route('transaction.create') }}" class="btn btn-primary">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>No Peminjaman</th>
                            <th>Anggota</th>
                            <th>Tanggal Kembali</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <a href="" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                                <a href="" class="btn btn-sm btn-success me-1">
                                    Edit
                                </a>
                                <form action="" method="post" class="d-inline"
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
@endsection

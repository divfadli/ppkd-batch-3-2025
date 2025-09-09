@extends('app')

@section('content')
    <div class="card">
        <div class="card-body">
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
                            <th>Aktual Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $val->trans_number }}</td>
                                <td>{{ $val->member->nama_anggota }}</td>
                                <td>{{ \Carbon\Carbon::parse($val->return_date)->format('d M Y') }}</td>
                                <td>
                                    {{ $val->actual_return_date ? \Carbon\Carbon::parse($val->actual_return_date)->format('d M Y') : '-' }}
                                </td>
                                <td>{{ number_format($val->fine, 0, '.', '.') }}</td>
                                <td>{{ $val->status == 1 ? 'Dipinjam' : 'Sudah Dikembalikan' }}</td>
                                <td class="text-center">
                                    @if ($val->status == 1)
                                        <form action="{{ route('transaction.return', $val->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="bi bi-arrow-return-right me-1"></i>
                                                Kembalikan
                                                <i class="bi bi-arrow-return-left ms-1"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('transaction.show', $val->id) }}"
                                        class="btn btn-success btn-sm me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Form Delete --}}
                                    <form action="{{ route('transaction.destroy', $val->id) }}" method="post"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

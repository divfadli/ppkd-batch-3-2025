@extends('app')
@section('title', $title)
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
                    <h3>{{ $title ?? 'Data Tamu' }}</h3>
                    <a href="{{ route('guest-information.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Tambah
                    </a>
                </div>

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Tamu</th>
                            <th>Tanggal Check-in & Check-out</th>
                            <th>Nomor Kamar</th>
                            <th>Kontak Tamu</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $val)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $val->name_guest }}</td>
                            <td>{{ $val->check_in }} s.d {{$val->check_out}}</td>
                            <td>{{ $val->number_room }}</td>
                            <td>{{ $val->phone}} / {{ $val->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('guest-information.edit', $val->id) }}"
                                    class="btn btn-sm btn-success me-1">
                                    Edit
                                </a>
                                <form action="{{ route('guest-information.destroy',$val->id) }}" method="post"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Tidak ada data tamu
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
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
                    <h3>{{ $title ?? 'Kategori Kamar' }}</h3>
                    <a href="{{ route('reservation.create') }}" class="btn btn-primary">
                        Tambah
                    </a>
                </div>

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Kamar</th>
                            <th>No Reservasi</th>
                            <th>Tamu</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $index => $val)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $val->room->name }}</td>
                            <td>{{ $val->reservation_number }}</td>
                            <td>
                                <small>
                                    Nama: {{ $val->guest_name }}
                                    <br>
                                    Email: {{ $val->guest_email }}
                                    <br>
                                    Tlp: {{ $val->guest_phone }}
                                </small>
                            </td>
                            <td>{{ $val->guest_check_in }}</td>
                            <td>{{ $val->guest_check_out }}</td>
                            <td><span class="{{ $val->isReserved_class }}">{{ $val->isReserved_text }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('reservation.edit', $val->id) }}" class="btn btn-sm btn-success me-1">
                                    Edit
                                </a>
                                <form action="{{ route('reservation.destroy',$val->id) }}" method="post"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Tidak ada data reservasi
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
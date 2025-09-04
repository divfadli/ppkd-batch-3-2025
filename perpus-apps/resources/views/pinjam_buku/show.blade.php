@extends('app')
@section('content')
    <div class="row">
        {{-- Data Peminjaman --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Peminjam</h3>

                    <table class="table">
                        <tr>
                            <th>Nomor Transaksi</th>
                            <th>{{ $borrow->trans_number ?? '' }}</th>
                        </tr>
                        <tr>
                            <th>Tanggal Kembali</th>
                            <th>
                                {{ \Carbon\Carbon::parse($borrow->return_date)->locale('id')->translatedFormat('d F Y') ?? '' }}
                            </th>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <th>{{ $borrow->note ?? '' }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- Data Anggota --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Anggota</h3>

                    <table class="table">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>{{ $borrow->member->nama_anggota ?? '' }}</th>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <th>
                                {{ $borrow->member->no_hp ?? '' }}
                            </th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>
                                {{ $borrow->member->email ?? '' }}
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- Data Detail Peminjaman --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Detail Peminjaman</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($borrow->detailBorrows as $key => $val)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $val->book->title }}</td>
                                    <td>{{ $val->book->publisher }}</td>
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

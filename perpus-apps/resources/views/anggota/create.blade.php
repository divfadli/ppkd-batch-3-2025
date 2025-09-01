@extends('app')
@section('title', $title ?? 'Form User')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h3 class="card-title">{{ $thirdtitle ?? '' }}</h3>

                <form action="{{ route('anggota.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_anggota" class="form-label">Nomor Anggota *</label>
                        <input type="text" name="nomor_anggota" id="nomor_anggota" class="form-control" placeholder="Nomor Anggota"
                            value="{{ old('nomor_anggota', $memberCode ?? '') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK *</label>
                        <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK"
                            value="{{ old('nik') }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_anggota" class="form-label">Nama Anggota *</label>
                        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" placeholder="Masukkan Nama Anggota"
                            value="{{ old('nama_anggota') }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">NO HP *</label>
                        <input type="tel" name="no_hp" id="no_hp" class="form-control" placeholder="Masukkan No HP"
                            value="{{ old('no_hp') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email"
                            value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="{{ url('anggota') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
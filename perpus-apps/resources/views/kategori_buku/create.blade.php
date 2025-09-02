@extends('app')

@section('title', $title ?? 'Form')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h3 class="card-title mb-4">{{ $thirdtitle ?? '' }}</h3>

                {{-- Global error alert --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf

                    {{-- Kategori Buku --}}
                    <div class="mb-3">
                        <label for="name_category" class="form-label">Kategori Buku *</label>
                        <input type="text" 
                               name="name_category" 
                               id="name_category" 
                               class="form-control @error('name_category') is-invalid @enderror"
                               placeholder="Masukkan nama Nama Kategori"
                               value="{{ old('name_category') }}">
                        @error('name_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   
                    {{-- Action buttons --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

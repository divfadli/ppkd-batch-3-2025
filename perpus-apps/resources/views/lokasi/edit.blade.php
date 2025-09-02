@extends('app')

@section('title', $title ?? 'Form')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                {{-- Global error alert --}}
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

                <form action="{{ route('lokasi.update', $edit->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    {{-- Code Location --}}
                    <div class="mb-3">
                        <label for="code_location" class="form-label">Kode Lokasi *</label>
                        <input type="text" 
                               name="code_location" 
                               id="code_location" 
                               class="form-control @error('code_location') is-invalid @enderror"
                               value="{{ old('code_location', $edit->code_location) }}" 
                               readonly>
                        @error('code_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Label --}}
                    <div class="mb-3">
                        <label for="label" class="form-label">Label *</label>
                        <input type="text" 
                               name="label" 
                               id="label" 
                               class="form-control @error('label') is-invalid @enderror"
                               placeholder="Masukkan nama label (contoh: Rak Novel)"
                               value="{{ old('label', $edit->label) }}">
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bookshelf --}}
                    <div class="mb-3">
                        <label for="bookshelf" class="form-label">Rak Buku *</label>
                        <input type="text" 
                               name="bookshelf" 
                               id="bookshelf" 
                               class="form-control @error('bookshelf') is-invalid @enderror"
                               value="{{ old('bookshelf', $edit->bookshelf) }}">
                        @error('bookshelf')
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

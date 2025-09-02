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

                <form action="{{ route('kategori.update', $edit->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    {{-- Kategori Buku --}}
                    <div class="mb-3">
                        <label for="name_category" class="form-label">Kategori Buku *</label>
                        <input type="text" 
                               name="name_category" 
                               id="name_category" 
                               class="form-control @error('name_category') is-invalid @enderror"
                               placeholder="Masukkan nama Nama Kategori"
                               value="{{ old('name_category', $edit->name_category) }}">
                        @error('name_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Action buttons --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

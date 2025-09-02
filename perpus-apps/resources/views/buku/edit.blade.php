@extends('app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title d-flex justify-content-between align-items-center mb-3">
                    <h3>Edit Buku</h3>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <form action="{{ route('buku.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" 
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $book->title) }}">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi</label>
                            <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}" 
                                        {{ old('location_id', $book->location_id) == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->label . ' - ' . $loc->bookshelf }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                        {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name_category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pengarang</label>
                        <input type="text" name="author" 
                               class="form-control @error('author') is-invalid @enderror"
                               value="{{ old('author', $book->author) }}">
                        @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <input type="text" name="publisher" 
                               class="form-control @error('publisher') is-invalid @enderror"
                               value="{{ old('publisher', $book->publisher) }}">
                        @error('publisher')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="date" name="date_publication"
                                   class="form-control @error('date_publication') is-invalid @enderror"
                                   value="{{ old('date_publication', $book->date_publication) }}">
                            @error('date_publication')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" 
                                   class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', $book->stock) }}">
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

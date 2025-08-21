@extends('app')
@section('title', $title ?? 'Form Kategori Kamar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h3 class="card-title">{{ $title ?? '' }}</h3>

                <form action="{{ isset($rooms) ? route('rooms.update', $rooms->id) : route('rooms.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($rooms))
                    @method('PUT')
                    @endif

                    {{-- Kategori Kamar --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori Kamar *</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Pilih Kategori Kamar</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $rooms->category->id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nama Kamar --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kamar *</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama"
                            value="{{ old('name', $rooms->name ?? '') }}" required>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Harga Kamar --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Kamar *</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Masukkan Harga"
                            value="{{ old('price', $rooms->price ?? '') }}" required>
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Fasilitas --}}
                    <div class="mb-3">
                        <label for="facility" class="form-label">Fasilitas Kamar *</label>
                        <textarea name="facility" id="facility" cols="30" rows="5" class="form-control"
                            required>{{ old('facility', $rooms->facility ?? '') }}</textarea>
                        @error('facility')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Kamar *</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                            required>{{ old('description', $rooms->description ?? '') }}</textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label for="image_cover" class="form-label">Gambar Kamar *</label>
                        <input type="file" name="image_cover" id="image_cover" class="form-control">
                        @if(isset($rooms) && $rooms->image_cover)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'. $rooms->image_cover)}}" alt="Gambar Kamar" width="150"
                                class="img-thumbnail img-fluid">
                        </div>
                        @endif
                        @error('image_cover')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Action Button --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
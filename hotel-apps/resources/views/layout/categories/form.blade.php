@extends('app')
@section('title', $title ?? 'Form Kategori Kamar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h3 class="card-title">{{ $title ?? '' }}</h3>

                <form
                    action="{{ isset($category_room) ? route('categories.update', $category_room->id) : route('categories.store') }}"
                    method="post">
                    @csrf
                    @if(isset($category_room))
                    @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama *</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama"
                            value="{{ old('name', $category_room->name ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
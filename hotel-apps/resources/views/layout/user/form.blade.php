@extends('app')
@section('title', $title ?? 'Form User')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h3 class="card-title">{{ $title ?? '' }}</h3>

                <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="post">
                    @csrf
                    @if(isset($user))
                    @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama *</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama"
                            value="{{ old('name', $user->name ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email"
                            value="{{ old('email', $user->email ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            {{ isset($user) ? 'Password (kosongkan jika tidak diubah)' : 'Password *' }}
                        </label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan Password" {{ isset($user) ? '' : 'required' }}>
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
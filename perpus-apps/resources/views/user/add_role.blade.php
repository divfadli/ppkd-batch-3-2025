@extends('app')
@section('title', 'Tambah User Role')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tambah User Role</h3>

            <form action="{{ route('user.updateRoles', $user->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Pilih Role</label>
                    <select name="roles[]" id="role" class="form-select" multiple>
                        @foreach ($roles as $role)
                            {{-- Contains() --}}
                            <option value="{{ $role->id }}"
                                {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-success">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

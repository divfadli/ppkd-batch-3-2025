@extends('app')

@section('title', $title ?? 'Form Information Guest')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @foreach($errors->all() as $err)
                <ul style="background-color: red;">
                    <li>{{ $err }}</li>
                </ul>
                @endforeach

                <h3 class="card-title">{{ $title ?? '' }}</h3>


                <form
                    action="{{ isset($guest) ? route('guest-information.update', $guest->id) : route('guest-information.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @if(isset($guest))
                    @method('PUT')
                    @endif

                    {{-- Status Tamu --}}
                    <div class="mb-3">
                        <label for="status_guest" class="form-label">Status Tamu *</label>
                        <select name="status_guest" id="status_guest" class="form-select" required>
                            <option value="" disabled
                                {{ old('status_guest', $guest->status_guest ?? '') == '' ? 'selected' : '' }}>
                                Pilih Status Tamu
                            </option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->name }}"
                                {{ old('status_guest', $guest->status_guest ?? '') == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('status_guest')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nama Tamu --}}
                    <div class="mb-3">
                        <label for="name_guest" class="form-label">Nama Tamu *</label>
                        <input type="text" name="name_guest" id="name_guest" class="form-control"
                            placeholder="Masukkan Nama" value="{{ old('name_guest', $guest->name_guest ?? '') }}"
                            required>
                        @error('name_guest')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Check In --}}
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Tanggal Check-in *</label>
                        <input type="date" name="check_in" id="check_in" class="form-control"
                            value="{{ old('check_in', $guest->check_in ?? '') }}" required>
                        @error('check_in')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Check Out --}}
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Tanggal Check-out *</label>
                        <input type="date" name="check_out" id="check_out" class="form-control"
                            value="{{ old('check_out', $guest->check_out ?? '') }}" required>
                        @error('check_out')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- No Kamar --}}
                    <div class="mb-3">
                        <label for="number_room" class="form-label">No Kamar *</label>
                        <select name="number_room" id="number_room" class="form-select" required>
                            <option value="" disabled
                                {{ old('number_room', $guest->number_room ?? '') == '' ? 'selected' : '' }}>
                                -- Pilih No --
                            </option>
                            <option value="A01"
                                {{ old('number_room', $guest->number_room ?? '') == 'A01' ? 'selected' : '' }}>A01
                            </option>
                            <option value="A02"
                                {{ old('number_room', $guest->number_room ?? '') == 'A02' ? 'selected' : '' }}>A02
                            </option>
                            <option value="A03"
                                {{ old('number_room', $guest->number_room ?? '') == 'A03' ? 'selected' : '' }}>A03
                            </option>
                        </select>
                        @error('number_room')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email"
                            value="{{ old('email', $guest->email ?? '') }}" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Telp --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">No Telepon *</label>
                        <input type="number" name="phone" id="phone" class="form-control"
                            placeholder="Masukkan Nomor Telepon" value="{{ old('phone', $guest->phone ?? '') }}"
                            required>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Alamat Tamu --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Tamu *</label>
                        <textarea name="address" id="address" cols="30" rows="3" class="form-control"
                            required>{{ old('address', $guest->address ?? '') }}</textarea>
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Kebutuhan Khusus Tamu --}}
                    <div class="mb-3">
                        <label class="form-label">Kebutuhan Khusus</label> <br>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="check_kebutuhan_khusus" id="ada" class="form-check-input"
                                onclick="toggleInput(true)"
                                {{ old('special_needs', $guest->special_needs ?? '') ? 'checked' : '' }}>
                            <label for="ada" class="form-check-label">Ada</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="check_kebutuhan_khusus" id="tidak" class="form-check-input"
                                onclick="toggleInput(false)"
                                {{ old('special_needs', $guest->special_needs ?? '') ? '' : 'checked' }}>
                            <label for="tidak" class="form-check-label">Tidak Ada</label>
                        </div>

                        <textarea name="special_needs" id="special_needs" cols="30" rows="3"
                            class="form-control mt-2 {{ old('special_needs', $guest->special_needs ?? '') ? '' : 'd-none' }}">{{ old('special_needs', $guest->special_needs ?? '') }}</textarea>

                        @error('special_needs')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <script>
                    function toggleInput(show) {
                        const kebutuhanKhusus = document.getElementById('special_needs');
                        if (show) {
                            kebutuhanKhusus.classList.remove('d-none');
                        } else {
                            kebutuhanKhusus.classList.add('d-none');
                            kebutuhanKhusus.value = ""; // optional: clear isi textarea kalau pilih "Tidak Ada"
                        }
                    }
                    </script>


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
@extends('layout')

@section('content')
@php
$judul = ucfirst($tipe) . ' Data';
$action = route('store_operasi', ['tipe' => $tipe]);
@endphp

<h2>{{ $judul }}</h2>

<form action="{{ $action }}" method="post">
    @csrf
    <label>Angka 1</label>
    <input type="number" name="angka1" value="{{ old('angka1') }}" required>
    <br><br>

    <label>Angka 2</label>
    <input type="number" name="angka2" value="{{ old('angka2') }}" required>
    <br><br>

    <button type="submit">Proses</button>
    <a href="{{ url()->previous() }}"><button type="button">Kembali</button></a>
</form>

@if ($errors->any())
<div style="color: red;">
    <strong>{{ $errors->first() }}</strong>
</div>
@endif

<h3>Hasil: {{ $jumlah ?? 0 }}</h3>
@endsection
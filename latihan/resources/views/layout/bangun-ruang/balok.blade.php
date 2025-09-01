@extends('layout.bangun-ruang.app')

@section('content')
<h1>Bangun Ruang Balok</h1>

<form action="{{ route('balok.operasi') }}" method="post">
    @csrf
    <label>Panjang</label>
    <input type="number" name="panjang" value="{{ old('panjang') }}" required>
    <br><br>

    <label>Lebar</label>
    <input type="number" name="lebar" value="{{ old('lebar') }}" required>
    <br><br>

    <label>Tinggi</label>
    <input type="number" name="tinggi" value="{{ old('tinggi') }}" required>
    <br><br>
    <button type="submit">Proses</button>
    <a href="{{ route('bangun-ruang') }}"><button type="button">Kembali</button></a>
</form>

@isset($hasil)
<h3>Hasil Perhitungan:</h3>
<p>Panjang: {{ $hasil['panjang'] }}</p>
<p>Lebar: {{ $hasil['lebar'] }}</p>
<p>Tinggi: {{ $hasil['tinggi'] }}</p>
<p>Luas Permukaan: {{ $hasil['luas'] }}</p>
<p>Volume: {{ $hasil['volume'] }}</p>
@endisset
@endsection
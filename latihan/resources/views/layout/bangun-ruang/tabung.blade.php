@extends('layout.bangun-ruang.app')

@section('content')
<h1>Bangun Ruang Tabung</h1>

<form action="{{ route('tabung.operasi') }}" method="post">
    @csrf
    <label>Jari-Jari</label>
    <input type="number" name="jari2" value="{{ old('jari2') }}" required>
    <br><br>

    <label>Tinggi</label>
    <input type="number" name="tinggi" value="{{ old('tinggi') }}" required>
    <br><br>
    <button type="submit">Proses</button>
    <a href="{{ route('bangun-ruang') }}"><button type="button">Kembali</button></a>
</form>

@isset($hasil)
<h3>Hasil Perhitungan:</h3>
<p>Jari-Jari: {{ $hasil['jari2'] }}</p>
<p>Tinggi: {{ $hasil['tinggi'] }}</p>
<p>Luas Permukaan: {{ $hasil['luas'] }}</p>
<p>Volume: {{ $hasil['volume'] }}</p>
@endisset
@endsection
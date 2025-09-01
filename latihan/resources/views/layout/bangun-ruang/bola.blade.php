@extends('layout.bangun-ruang.app')

@section('content')
<h1>Bangun Ruang Bola</h1>

<form action="{{ route('bola.operasi') }}" method="post">
    @csrf
    <label>Jari-Jari</label>
    <input type="number" name="jari2" value="{{ old('jari2') }}" required>
    <br><br>

    <button type="submit">Proses</button>
    <a href="{{ route('bangun-ruang') }}"><button type="button">Kembali</button></a>
</form>

@isset($hasil)
<h3>Hasil Perhitungan:</h3>
<p>Jari-Jari: {{ $hasil['jari2'] }}</p>
<p>Luas Permukaan: {{ $hasil['luas'] }}</p>
<p>Volume: {{ $hasil['volume'] }}</p>
@endisset
@endsection
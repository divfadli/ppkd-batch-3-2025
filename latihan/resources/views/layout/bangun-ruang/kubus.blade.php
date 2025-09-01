@extends('layout.bangun-ruang.app')

@section('content')
<h1>Bangun Ruang Kubus</h1>

<form action="{{ route('kubus.operasi') }}" method="post">
    @csrf
    <label>Sisi</label>
    <input type="number" name="sisi" value="{{ old('sisi') }}" required>
    <br><br>

    <button type="submit">Proses</button>
    <a href="{{ route('bangun-ruang') }}"><button type="button">Kembali</button></a>
</form>

@isset($hasil)
<h3>Hasil Perhitungan:</h3>
<p>Sisi: {{ $hasil['sisi'] }}</p>
<p>Luas Permukaan: {{ $hasil['luas'] }}</p>
<p>Volume: {{ $hasil['volume'] }}</p>
@endisset
@endsection
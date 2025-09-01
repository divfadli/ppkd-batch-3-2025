@extends('layout.bangun-ruang.app')

@section('content')
<h1>Bangun Ruang</h1>
<ul>
    <li><a href="{{ route('kubus') }}">Kubus</a></li>
    <li><a href="{{ route('balok') }}">Balok</a></li>
    <li><a href="{{ route('limas-segi-empat') }}">Limas Segi Empat</a></li>
    <li><a href="{{ route('tabung') }}">Tabung</a></li>
    <li><a href="{{ route('bola') }}">Bola</a></li>
</ul>
@endsection
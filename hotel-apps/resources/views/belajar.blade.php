@extends('layout')

@section('content')
<p>Selamat datang di halaman belajar Laravel.</p>

<ul>
    @foreach (['tambah', 'kurang', 'kali', 'bagi'] as $op)
    <li><a href="{{ route('operasi', ['tipe' => $op]) }}">{{ ucfirst($op) }}</a></li>
    @endforeach
</ul>
@endsection
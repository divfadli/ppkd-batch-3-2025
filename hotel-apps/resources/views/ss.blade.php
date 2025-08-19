<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Laravel</title>
</head>

<body>
    <h1>Aritmatika Dasar</h1>
    <!-- <a href="{{url('tambah-data')}}">Tambah</a> -->
    <a href="{{route('tambah')}}">Tambah</a>
    <!-- <a href="tambah">Tambah</a> -->
    <a href="{{ route('kurang') }}">Kurang</a>
    <a href="{{ route('bagi') }}">Bagi</a>
    <a href="{{ route('kali') }}">Kali</a>
</body>

</html>
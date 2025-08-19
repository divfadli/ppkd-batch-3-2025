<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Belajar Laravel</title>
</head>

<body>
    <h1>Aritmatika Dasar</h1>
    <a href="{{ url('tambah') }}">Tambah</a>
    <a href="{{ url('kurang') }}">Kurang</a>
    <a href="{{ url('kali') }}">Kali</a>
    <a href="{{ url('bagi') }}">Bagi</a>
    <hr>
    <br><br><br>

    <h1>Data Pengguna</h1>
    <table width="100%" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $val)
            <tr>
                <td>{{ $key += 1 }}</td>
                <td>{{$val->name ?? ''}}</td>
                <td>{{$val->email ?? ''}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @yield('content')
</body>

</html>
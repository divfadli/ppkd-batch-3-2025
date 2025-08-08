<!-- Function -->

<?php

// $nama = "Fadil";
// echo $nama;

// $nama = "Bambang";
// echo $nama;

function introduce($name = "Guest", $age = null){
    // echo" Fadlilah Divy";
    return "Nama saya adalah $name, umur saya $age tahun <br>";
}

// introduce();
echo introduce(); // default
echo introduce("Divy",24);
echo introduce("Bambang", age: 25);

function luasPersegiPanjang($panjang, $lebar) {
    return "Luas:". $panjang * $lebar . "<br>";
}

echo luasPersegiPanjang(5, 2);
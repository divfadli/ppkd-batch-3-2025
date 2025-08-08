<?php

function debug($data){
    print_r($data);
}
// array sebuah tipe data,
// boolean, string, number / integer, float

// array index
$tas_buah = ["Semangka", "Nanas", "Jeruk"];
echo $tas_buah[0]; // output 1 string
$tas_buah[] = "Pisang";
echo "<br>";
print_r($tas_buah); // output array (hanya data saja)
echo "<br>";
var_dump($tas_buah); // Pengecekan data secara detail type data
echo "<br>"; 

foreach ($tas_buah as $key => $val) {
    echo "Index dari " . $val . " adalah " . $key . "<br>";
}


// array associative / asosiatif (array dengan indeks berupa string)
$keranjang = [
    'buah' => ['Nanas', 'Alpukat', 'Mangga'],
    'sayuran' => 'Bayam'
];
print_r($keranjang['buah'][2]);
echo "<br>"; 
print_r($keranjang['sayuran']);
echo "<br>"; 

foreach ($keranjang as $key => $value) {
    echo $key . ": ";
    
    if (is_array($value)) {
        echo implode(', ', $value);
    } else {
        echo $value;
    }

    echo "<br>";
}
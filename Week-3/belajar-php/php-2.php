<?php

// Perkondisian / Percabangan
// if else
// if else if else
//  switch

$n = 10;
if ($n < 20) {
    echo "Nilai < 20";
}else{
    echo "Nilai > 20";
}
echo "<br>";

$x = 30;
if ($x < 20){
    echo "Nilai < 20";
}else if ($x == 20){
    echo "Nilai Sama";
}else{
    echo "Nilai > 20";
}
echo "<br> <br>";

// If Ternary
$no = 1;
echo "Ternary Operator <br>";
$hasil = ($no % 2 == 0 ) ? 'Genap' : 'Ganjil';
echo $no . "% 2 == 0" . " =>" . $hasil; 
echo "<br>";
// If Ternary If Else If Else
$hasil = ($no % 2 == 0 ) ? 'Genap' : (($no %2 != 0) ? 'Ganjil' : 'Tak Terdefinisi');

echo "<br>";
$nilai = 75;
// Jika nilai lebih dari atau sama dengan 80, maka output: A
// Jika nilai lebih dari atau sama dengan 70, maka output: B
// Jika nilai lebih dari atau sama dengan 60, maka output: C
// D


$result = ($nilai >= 80) ? 'A' : (($nilai >= 70) ? 'B' : (($nilai >= 60) ? 'C' : 'D'));
echo $result;
echo "<br>";

$score = 68;
$result = '';
switch(true) {
    case ($score >= 80):
        $result = 'A';
        break;
    case ($score >= 70):
        $result = 'B';
        break;
    case ($score >= 60):
        $result = 'C';
        break;
    default:
        $result = 'D';
        break;
}
echo $result;
echo "<br> <br>";

$day = 'Senin';
$resultDay = '';
switch(true){
    case (strtolower($day) == 'senin'):
        $resultDay = 'Week Day';
        break;
    case (strtolower($day) == 'selasa'):
        $resultDay = 'Week Day';
        break;
    case (strtolower($day) == 'rabu'):
        $resultDay = 'Week Day';
        break;
    case (strtolower($day) == 'kamis'):
        $resultDay = 'Week Day';
        break;
    case (strtolower($day) == 'jumat'):
        $resultDay = 'Week Day';
        break;
    case (strtolower($day) == 'sabtu'):
        $resultDay = 'Week End';
        break;
    case (strtolower($day) == 'minggu'):
        $resultDay = 'Week End';
        break;
    default:
        $resultDay = 'Input Salah';
        break;
}

switch($day){
    case "Senin":
    case "Selasa":
    case "Rabu":
    case "Kamis":
    case "Jumat":
        $resultDay = "Weekday";
        break;
    case "Sabtu":
    case "Minggu":
        $resultDay = "Weekend";
        break;
    default:
        $resultDay = 'Ini Bukan Hari!';
}
echo $resultDay;
echo "<br>";
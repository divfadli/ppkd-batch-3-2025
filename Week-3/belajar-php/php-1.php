<?php

echo "Hallo PHP" . "<br>";
echo 123;
echo "<br>";
echo true;
echo "<br>";
echo false;
echo "<br>";
print_r("Hallo" . "<br>");
var_dump("tesss");
echo "<br>";


$nama = "Udin";
echo $nama;

// HTML di dalam PHP
$html = "<h1> HTML di dalam PHP </h1>";
echo $html;
echo "<br> <br>";

// Operator Aritmatika + - * /
$nilai1 = 50;
$nilai2 = 5;
echo "Operasi Aritmatika: <br>";
echo $nilai1 .  "+" . $nilai2 . "=" . $nilai1 + $nilai2 . "<br>";
echo $nilai1 .  "-" . $nilai2 . "=" . $nilai1 - $nilai2 . "<br>";
echo $nilai1 .  "x" . $nilai2 . "=" . $nilai1 * $nilai2 . "<br>";
echo $nilai1 .  "/" . $nilai2 . "=" . $nilai1 / $nilai2 . "<br>";
echo "<br> <br>";

// Operator Assigment = += -= *= /= %= .=
echo "Operasi Assigment: <br>";
echo "`.=` <br>";
$nama = "Dino";
$nama .= " ";
$nama .= "Danuarta";
$nama .= " ";
$nama .= "Siregar";
echo $nama . "<br>";
echo "`+=` <br>";
echo $nilai1 . "+" . $nilai2 . "=". $nilai1 += $nilai2;
echo "<br>";
echo "`-=` <br>";
echo $nilai1 . "-" . $nilai2 . "=". $nilai1 -= $nilai2;
echo "<br>";
echo "`*=` <br>";
echo $nilai1 . "x" . $nilai2 . "=". $nilai1 *= $nilai2;
echo "<br>";
echo "`/=` <br>";
echo $nilai1 . "/" . $nilai2 . "=". $nilai1 /= $nilai2;
echo "<br>";
echo "`%=` <br>";
echo $nilai1 . "%" . $nilai2 . "=". $nilai1 %= $nilai2;
echo "<br> <br>";

// Perbandingan <, >, <=, >=, ==, !=
echo "Perbandingan: <br>";
echo "`<` <br>";
var_dump(5<5);
echo "<br>";
echo "`>` <br>";
var_dump(5>5);
echo "<br>";
echo "`<=` <br>";
var_dump(5<=5);
echo "<br>";
echo "`>=` <br>";
var_dump(5>=5);
echo "<br>";
echo "`==` <br>";
var_dump(5==5);
echo "<br>";
echo "`!=` <br>";
var_dump(5!=5);
echo "<br> <br>";

// Gerbang Logika: &&, ||, !
echo "Gerbang Logika: <br>";
$y = 5;
echo "y <= 5 <br>";
var_dump($y <=5 );
echo "<br>";
echo "y % 2 == 0 <br>";
var_dump($y % 2 == 0);
echo "<br>";
echo "y <= 5 && y % 2 == 0 <br>";
var_dump(($y <= 5 ) && ($y % 2 == 0));
echo "<br>";
echo "y <= 5 || y % 2 == 0 <br>";
var_dump(($y <= 5 ) || ($y % 2 == 0));
echo "<br>";
echo "!(y <= 5 || y % 2 == 0) <br>";
var_dump(!($y <= 5 ) || ($y % 2 == 0));
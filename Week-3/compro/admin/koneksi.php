<?php
$_HOST = "localhost";
$_USERNAME = "root";
$_PASSWORD = ""; #PPKD
$_DATABASE = "db_porto_3_2025"; #PPKD
// $_PASSWORD = "password123"; #HOME
// $_DATABASE = "compro"; #HOME

$koneksi = mysqli_connect($_HOST, $_USERNAME, $_PASSWORD, $_DATABASE);
if (!$koneksi) {
  echo "Koneksi gagal";
}
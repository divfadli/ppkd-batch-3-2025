<?php
$_HOST = "localhost";
$_USERNAME = "root";
$_PASSWORD = ""; #PPKD
$_DATABASE = "my_portofolio";
// $_PASSWORD = "password123"; #HOME

$koneksi = mysqli_connect($_HOST, $_USERNAME, $_PASSWORD, $_DATABASE);
if (!$koneksi) {
  echo "Koneksi gagal";
}
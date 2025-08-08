<!-- 
 Operator logika
 AND ==> &&
 OR ==> ||
-->
<form action="" method="post">
    <!-- <label for="">Nilai</label>
    <input type="number" name="nilai" id="">
    <br> -->
    <label for="">Username</label>
    <input type="text" name="username" id="">
    <br>
    <br>
    <label for="">Password</label>
    <input type="password" name="password" id="">
    <br>
    <button type="submit">Simpan</button>
</form>

<?php
// isset: Tidak kosong, empty: kosong
// !isset: kosong, !empty: tidak kosong
    $ext_username = 'admin';
    $ext_password = 'admin';
if(isset($_POST['username'])){
    $username = $_POST['username']; // Undefined index array nilai
    $password = $_POST['password']; // Undefined index array nilai

    if($username == $ext_username and $password == $ext_password){
        echo "Login Berhasil";
    }else{
        echo "Login Gagal";
    }
}



    // $nilai = isset($_POST['nilai']) ? $_POST['nilai'] : null;

    // if($nilai >=90 && $nilai == 100){
    //     echo "Grade A";
    // }else{
    //     echo "Grade tidak ditemukan";
    // }
?>
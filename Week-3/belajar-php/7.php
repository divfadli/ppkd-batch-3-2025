<?php

?>

<form action="" method="post">
    <label for="">Nilai</label>
    <input type="number" name="nilai" placeholder="Masukan nilai anda">
    <br>
    <button type="submit">Simpan</button>
</form>

<?php
if(isset($_POST['nilai'])){
    $nilai = $_POST['nilai'];
    $grade = gradeNilai($nilai);
    echo "<h1>Nilai anda: {$nilai}</h1>";
    echo "<h1>Grade anda: {$grade}</h1>";
}
?>

<!-- 
Buat program sederhana dengan 1 buah input bernama nilai,
Jika nilai 90 sampai 100, maka grade nya A
Jika nilai 80 sampai 89, maka grade nya B
Jika nilai 70 sampai 79, maka grade nya C
Jika nilai 60 sampai 69, maka grade nya D
Jika nilai 0 sampai 59, maka grade nya E
 -->
<?php
    function gradeNilai($nilai){
    $result = '';
    if ($nilai>= 90 && $nilai <=100){
       $result = 'A';
    }else if ($nilai>= 80 && $nilai <90){
        $result = 'B';
    }else if ($nilai>= 70 && $nilai <80){
        $result = 'C';
    }else if ($nilai>= 60 && $nilai <70){
        $result = 'D';
    }else if ($nilai>= 0 && $nilai <60){
        $result = 'E';
    }
    
    return $result;
    }
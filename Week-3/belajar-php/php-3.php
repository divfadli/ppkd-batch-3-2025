<?php
// Struktur Kendali
// 1. Perulangan FOR, While, Do.. While, foreach(perulangan khusus array)

// For
for ($i=0; $i < 5; $i++) { 
    echo "For: $i <br>";
}   

// while
$a = 0;
while ($a <= 3) {
    echo "While: $a <br>";
    $a++;
}

// do.. while
do {
    echo "Do While: $a <br>";
    $a--;
} while ($a >= 0);
echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <table border="1" cellpadding="10" cellspacing="0">
        <?php
            for ($i=0; $i < 5 ; $i++) { 
        ?>
        <tr>
            <?php for($j = 0; $j < 5; $j++){
            ?>
            <?php if($i % 2 == 0){
             ?>
            <td style="background-color: red;"><?= ($i+1) . ",". ($j+1) ?></td>
            <?php }else{
            ?>
            <td style="background-color: blue;"><?= ($i+1) . ",". ($j+1) ?></td>
            <?php  } ?>
            <?php } ?>
        </tr>
        <?php } ?>
    </table> -->
    <!-- <table border="1" cellpadding="10" cellspacing="0">
        <?php
            for ($i=0; $i < 5 ; $i++) { 
            if($i % 2 == 0){
             ?>
        <tr style="background-color: red;">
            <?php }else{?>
        <tr style="background-color: yellow;">
            <?php } ?>
            <?php for($j = 0; $j < 5; $j++){
        ?>
            <td><?= ($i+1) . ",". ($j+1) ?></td>

            <?php } ?>
        </tr>
        <?php } ?>
    </table> -->
    <!-- <table border="1" cellpadding="10" cellspacing="0">
        <?php
        for ($i=0; $i < 5 ; $i++) { 
        if($i % 2 == 0){
            echo "<tr style='background-color: blue;'>";
        }else{
            echo "<tr style='background-color: yellow;'>";
        } ?>
        <?php for($j = 0; $j < 5; $j++){
            ?>
        <td><?= ($i+1) . ", ". ($j+1) ?></td>

        <?php } ?>
        </tr>
        <?php } ?>
    </table> -->
    <table border="1" cellpadding="10" cellspacing="0">
        <?php
        for ($i=0; $i < 5 ; $i++) { 
        if($i % 2 == 0){
            echo "<tr style='background-color: green;'>";
        }else{
            echo "<tr style='background-color: gray;'>";
        } ?>
        <?php for($j = 0; $j < 5; $j++){     
            echo "<td>" . ($i+1) . ", " . ($j+1) . "</td>";
        } ?>
        </tr>
        <?php } ?>
    </table>
</body>

</html>
<?php
// Array
// $foods = array("Burger", "Nasi Padang", "Gado-Gado"); // Penulisan Array Versi lama
$foods = ['Burger', "Nasi Padang", "Gado-Gado", "Nasi Goreng"];
var_dump($foods[2]);
echo "<br>";

$foods[] = "Pizza";
var_dump($foods);
echo "<br>";

$fills = ["Makaroni", "Spagetti", "Nasi Uduk"];
foreach($fills as $fill){
    $foods[] = $fill;
}
// array_push($foods, "Makaroni", "Spagetti");
var_dump($foods);

// $search = ['Nasi']; // array pencarian

$result = [];

foreach ($foods as $food) {
    // foreach ($search as $word) {
        // Cek apakah $word ada di dalam string $food
        if (strpos($food, 'Nasi') !== false) {
            $result[] = $food;
            // break; // jika sudah ketemu kata, langsung keluar loop pencarian
        }
    // }
}
echo "<br>";

print_r($result); // Output: Array ( [0] => Nasi )


?>
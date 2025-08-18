<?php
// Load countries data
$countriesJson = file_get_contents('admin/data/countries.json');
$countries = json_decode($countriesJson, true);

// Fungsi format nomor telepon
function formatPhone($phone, $countries) {
    $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);

    foreach ($countries as $country) {
        $root = $country['idd']['root'] ?? '';
        $suffixes = $country['idd']['suffixes'] ?? [''];
        foreach ($suffixes as $suffix) {
            $fullRoot = $root . $suffix;
            if (strpos($cleanPhone, $fullRoot) === 0) {
                $number = substr($cleanPhone, strlen($fullRoot));
                $blocks = str_split($number, 4); // format 4 digit per block
                return $fullRoot . ' ' . implode(' ', $blocks);
            }
        }
    }

    return $cleanPhone;
}
?>

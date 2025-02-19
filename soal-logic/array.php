<?php
// buat sebuah function 
function sorting($data)
{
    // Pisahkan huruf dan angka
    $huruf = array_filter($data, function ($item) {
        return is_string($item);
    });
    $angka = array_filter($data, function ($item) {
        return is_int($item);
    });

    // Urutkan huruf dan angka
    sort($huruf);
    sort($angka);

    // Gabungkan hasilnya
    return array_merge($huruf, $angka);
}

// data
$data = [12, 9, 30, "A", "M", 99, 82, "J", "N", "B"];
$sort = sorting($data);
print_r($sort); // Output: Array ( [0] => A [1] => B [2] => J [3] => M [4] => N [5] => 9 [6] => 12 [7] => 30 [8] => 82 [9] => 99 )

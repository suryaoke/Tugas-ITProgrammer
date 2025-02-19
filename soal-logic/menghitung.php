<?php

function menghitung($input)
{
    
    $jumlahKarakter = [];

    // Menghitung  karakter
    $panjang = strlen($input);

    // Looping 
    for ($i = 0; $i < $panjang; $i++) {
       
        $karakter = $input[$i];

        // Cek apakah karakter sudah ada dalam array jumlahKarakter
        if (array_key_exists($karakter, $jumlahKarakter)) {
            // Jika sudah ada, tambahkan jumlah kemunculannya
            $jumlahKarakter[$karakter]++;
        } else {
           
            $jumlahKarakter[$karakter] = 1;
        }
    }

    // Mengurutkan array 
    ksort($jumlahKarakter);

    return $jumlahKarakter;
}


print_r(menghitung("Hello World"));
/*
Output:
Array
(
    [ ] => 1  // Spasi muncul 1 kali
    [H] => 1   // Huruf H muncul 1 kali
    [W] => 1   // Huruf W muncul 1 kali
    [d] => 1   // Huruf d muncul 1 kali
    [e] => 1   // Huruf e muncul 1 kali
    [l] => 3   // Huruf l muncul 3 kali
    [o] => 2   // Huruf o muncul 2 kali
    [r] => 1   // Huruf r muncul 1 kali
)
*/

print_r(menghitung("Bismillah"));
/*
Output:
Array
(
    [B] => 1   // Huruf B muncul 1 kali
    [a] => 1   // Huruf a muncul 1 kali
    [h] => 1   // Huruf h muncul 1 kali
    [i] => 2   // Huruf i muncul 2 kali
    [l] => 2   // Huruf l muncul 2 kali
    [m] => 1   // Huruf m muncul 1 kali
    [s] => 1   // Huruf s muncul 1 kali
)
*/
 
print_r(menghitung("MasyaAllah"));
/*
Output:
Array
(
    [A] => 1   // Huruf A muncul 1 kali
    [M] => 1   // Huruf M muncul 1 kali
    [a] => 3   // Huruf a muncul 3 kali
    [h] => 1   // Huruf h muncul 1 kali
    [l] => 2   // Huruf l muncul 2 kali
    [s] => 1   // Huruf s muncul 1 kali
    [y] => 1   // Huruf y muncul 1 kali
)
*/

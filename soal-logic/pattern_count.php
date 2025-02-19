<?php
function pattern($text, $pattern)
{
    // Menghitung panjang teks
    $textLength = strlen($text);
    $patternLength = strlen($pattern);
    $count = 0;

     // Jika panjang pola sama dengan 0, kembalikan 0
    if ($patternLength == 0) {
        return 0;
    }

    for ($i = 0; $i <= $textLength - $patternLength; $i++) {
        $match = true;
        for ($j = 0; $j < $patternLength; $j++) {
            if ($text[$i + $j] != $pattern[$j]) {
                $match = false;
                break;
            }
        }
        if ($match) {
            $count++;
        }
    }

    return $count;
}


echo pattern("palindrom", "ind") . "\n"; // Output: 1
echo pattern("ababab", "aba") . "\n";    // Output: 2
echo pattern("abakadabra", "ab") . "\n"; // Output: 2
echo pattern("aaaaaa", "aa") . "\n";     // Output: 5
echo pattern("hello", "") . "\n";        // Output: 0
echo pattern("hell", "hello") . "\n";    // Output: 0

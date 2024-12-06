<?php

$inputFile = __DIR__.'/01-input.txt';

$colA = [];
$colB = [];

$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = fgets($f);
    $line = explode(" ", preg_replace('/\s+/', ' ', trim($line)));

    $colA[] = $line[0];
    $colB[] = $line[1];
}

fclose($f);

sort($colA);
sort($colB);

foreach ($colA as $key => $value) {
    $diff = $value - $colB[$key];
    $solution = $solution + abs($diff);    
}

echo $solution;
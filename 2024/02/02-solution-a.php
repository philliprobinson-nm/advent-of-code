<?php

$inputFile = __DIR__.'/02-input.txt';

$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = fgets($f);

    $orig = $adupe = $rdupe = explode(" ", $line);

    sort($adupe);
    rsort($rdupe);

    if ($orig == $adupe || $orig == $rdupe) {
        $safe = true;
        
        for ($i=0; $i<count($orig); $i++) {
            if ($i == count($orig) - 1) {
                if ($safe) {$solution++;}
                continue;
            } else {
                $diff = $orig[$i] - $orig[$i+1];

                if (abs($diff) < 1 || abs($diff) > 3) {
                    $safe = false;
                }
            }
        }
    } 
}

fclose($f);

echo $solution;
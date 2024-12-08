<?php

$inputFile = __DIR__.'/07-input.txt';

$rows = [];
$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = str_replace(["\r", "\n"], "", fgets($f));

    $parts = explode(": ", $line);
    $test = $parts[0];
    $operands = explode(" ", $parts[1]);

    $rows[] = [$test, $operands];
}

fclose($f);

function getCombs(array $operands) {
    $count = count($operands) - 1;
    $combs = [];

    for($i=0; $i < 2 ** $count; $i++) {
        $combs[] = str_pad(decbin($i), $count, "0", STR_PAD_LEFT);
    }

    return $combs;
}

$rows = array_filter($rows, function($row) {
    $test = $row[0];
    $operands = $row[1];
    $combs = getCombs($operands);
    
    foreach ($combs as $comb) {
        $total = $comb[0] === "0" ? $operands[0] + $operands[1] : $operands[0] * $operands[1];

        for($i=2; $i < count($operands); $i++) {
            if ($comb[$i - 1] === "0") {
                $total = $total + $operands[$i];
            } else {
                $total = $total * $operands[$i];
            }
        }

        if ($total == $test) {
            return true;
        }
    }
});

$solution = array_reduce($rows, function($total, $row) {
    return $total = $total + $row[0];
});

echo $solution;
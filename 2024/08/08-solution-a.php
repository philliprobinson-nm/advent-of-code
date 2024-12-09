<?php

$inputFile = __DIR__.'/08-input.txt';

$map = [];
$antennas = [];
$solution = [];

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = str_replace(["\r", "\n"], "", fgets($f));

    if (!empty($line)) {
        $map[] = $line;
    }
}

fclose($f);

for ($y=0; $y<count($map); $y++) {
    for ($x=0; $x<strlen($map[$y]); $x++) {
        if ($map[$y][$x] != ".") {
            $antennas[] = ["x" => $x, "y" => $y, "freq" => $map[$y][$x]];
        }
    }    
}

foreach ($antennas as $antennaA) {
    foreach ($antennas as $antennaB) {
        if ($antennaA == $antennaB || $antennaA["freq"] != $antennaB["freq"]) {
            continue;
        }

        $xDiff = $antennaB["x"] - $antennaA["x"];
        $yDiff = $antennaB["y"] - $antennaA["y"];

        $antiNodeX = $antennaB["x"] + $xDiff;
        $antiNodeY = $antennaB["y"] + $yDiff;

        if ($antiNodeX < 0 || $antiNodeY < 0 || $antiNodeX >= strlen($map[0]) || $antiNodeY >= count($map)) {
            continue;
        }

        $solution[$antiNodeX.",".$antiNodeY] = true;
    }
}

$solution = count($solution);

echo $solution;
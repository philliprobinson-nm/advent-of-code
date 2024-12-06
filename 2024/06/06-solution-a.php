<?php

$inputFile = __DIR__.'/06-input.txt';

$map = [];
$guardExists = true;
$guardCurPos = ["x" => null, "y" => null];
$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = str_replace(["\r", "\n"], "", fgets($f));

    $map[] = $line;
}

fclose($f);

while ($guardExists === true) {
    $lookAhead = "";

    if (!isset($guardCurPos["x"]) || !isset($guardCurPos["y"])) {
        $guardCurRow = array_filter($map, function($value) {
            return str_contains($value, '^');
        });

        $guardCurPos["y"] = key($guardCurRow);
        $guardCurPos["x"] = strpos($guardCurRow[$guardCurPos["y"]], "^");
    }

    $guardCurDir = substr($map[$guardCurPos["y"]], $guardCurPos["x"], 1);

    // North && South
    if ($guardCurDir == "^" || $guardCurDir == "v") {
        if ($guardCurPos["y"] <= 0 || $guardCurPos["y"] >= count($map) - 1) {
            $solution++;
            break;
        }

        if ($guardCurDir == "^") {$movement = -1; $nextDir = ">";}
        if ($guardCurDir == "v") {$movement = 1; $nextDir = "<";}

        $lookAhead = substr($map[$guardCurPos["y"] + $movement], $guardCurPos["x"], 1);

        if ($lookAhead == "#") {
            $map[$guardCurPos["y"]] = str_replace($guardCurDir, $nextDir, $map[$guardCurPos["y"]]);

            continue;
        }
        
        $map[$guardCurPos["y"]] = substr_replace($map[$guardCurPos["y"]], "x", $guardCurPos["x"], 1);
        $guardCurPos["y"] = $guardCurPos["y"] + $movement;
        $map[$guardCurPos["y"]] = substr_replace($map[$guardCurPos["y"]], $guardCurDir, $guardCurPos["x"], 1);
    }

    // West && East
    if ($guardCurDir == "<" || $guardCurDir == ">") {
        if ($guardCurPos["x"] < 1 || $guardCurPos["x"] >= strlen($map[$guardCurPos["y"]]) - 1) {
            $solution++;
            break;
        }

        if ($guardCurDir == "<") {$movement = -1; $nextDir = "^";}
        if ($guardCurDir == ">") {$movement = 1; $nextDir = "v";}

        $lookAhead = substr($map[$guardCurPos["y"]], $guardCurPos["x"] + $movement, 1);

        if ($lookAhead == "#") {
            $map[$guardCurPos["y"]] = str_replace($guardCurDir, $nextDir, $map[$guardCurPos["y"]]);

            continue;
        }
        
        $map[$guardCurPos["y"]] = substr_replace($map[$guardCurPos["y"]], "x", $guardCurPos["x"], 1);
        $guardCurPos["x"] = $guardCurPos["x"] + $movement;
        $map[$guardCurPos["y"]] = substr_replace($map[$guardCurPos["y"]], $guardCurDir, $guardCurPos["x"], 1);
    }

    if ($lookAhead == ".") {$solution++;}
}

echo $solution;
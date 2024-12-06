<?php

$inputFile = __DIR__.'/04-input.txt';

$crossword = [];
$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $crossword[] = str_split(trim(fgets($f)));
}

fclose($f);

$rowCount = count($crossword) - 1;
$maxRowLimit = $rowCount - 3;

for ($i=0; $i<=$rowCount; $i++) {
    $charCount = count($crossword[$i]) - 1;
    $maxCharLimit = $charCount - 3;

    $possiblyXmas = [];
    
    for ($j=0; $j<=$charCount; $j++) {
        if ($crossword[$i][$j] == "X") {

            // East
            if ($j <= $maxCharLimit) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i][$j + 1] . $crossword[$i][$j + 2] . $crossword[$i][$j + 3];
            }

            // West
            if ($j >= 3) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i][$j - 1] . $crossword[$i][$j - 2] . $crossword[$i][$j - 3];
            }

            // North
            if ($i <= $maxRowLimit) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i + 1][$j] . $crossword[$i + 2][$j] . $crossword[$i + 3][$j];
            }

            // South
            if ($i >= 3) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i - 1][$j] . $crossword[$i - 2][$j] . $crossword[$i - 3][$j];
            }

            // North East
            if ($j <= $maxCharLimit && $i <= $maxRowLimit) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i + 1][$j + 1] . $crossword[$i + 2][$j + 2] . $crossword[$i + 3][$j + 3];
            }

            // South West
            if ($j >= 3 && $i >= 3) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i - 1][$j - 1] . $crossword[$i - 2][$j - 2] . $crossword[$i - 3][$j - 3];
            }

            // North West
            if ($i <= $maxRowLimit && $j >= 3) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i + 1][$j - 1] . $crossword[$i + 2][$j - 2] . $crossword[$i + 3][$j - 3];
            }

            // South East
            if ($i >= 3 && $j <= $maxRowLimit) {
                $possiblyXmas[] = $crossword[$i][$j] . $crossword[$i - 1][$j + 1] . $crossword[$i - 2][$j + 2] . $crossword[$i - 3][$j + 3];
            }
        }
    }

    if (isset(array_count_values($possiblyXmas)["XMAS"])) {
        $solution = $solution + array_count_values($possiblyXmas)["XMAS"];
    }
}

echo $solution;
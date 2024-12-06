<?php

$inputFile = __DIR__.'/03-input.txt';

$regExp = '/(?:mul\()(\d{1,3},\d{1,3})(?:\))/m';

$line = ""; 
$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = $line . fgets($f);
}

fclose($f);

preg_match_all($regExp, $line, $matches, PREG_SET_ORDER, 0);

foreach ($matches as $value) {
    $mul = explode(",", $value[1]);
    
    $solution = $solution + ($mul[0]*$mul[1]);
}

echo $solution;
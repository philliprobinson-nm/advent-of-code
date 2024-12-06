<?php

$inputFile = __DIR__.'/05-input.txt';

$rules = [];
$pages = [];
$solution = 0;

$f = fopen($inputFile, 'r');

while (!feof($f)) {
    $line = str_replace(["\r", "\n"], "", fgets($f));

    if (str_contains($line, "|")) {
        $rules[] = explode("|", $line);
    } elseif (str_contains($line, ",")) {
        $pages[] = explode(",", $line);
    }
}

fclose($f);

for ($i=0; $i<count($pages); $i++) {    
    foreach ($rules as $rule) {
        if (in_array($rule[0], $pages[$i]) && in_array($rule[1], $pages[$i])) {
            $key[0] = array_search($rule[0], $pages[$i]);
            $key[1] = array_search($rule[1], $pages[$i]);

            if ($key[0] > $key[1]) {            
                continue 2;
            }

        }
    }
    $midKey = floor(count($pages[$i]) / 2);
    
    $solution = $solution + $pages[$i][$midKey];
}

echo $solution;
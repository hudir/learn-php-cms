<?php

$file = 'example.txt';

if ($handle = fopen($file, 'w')) {
    fwrite($handle, "I really do not know why put it inside a folder then it not works");
    fclose($handle);
} else {
    echo "the application can not write on the files";
}
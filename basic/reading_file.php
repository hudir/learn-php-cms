<?php

$file = 'example.txt';

if ($handle = fopen($file, 'r')) {

    echo $content = fread($handle, filesize($file)); // each bit equal a character

    fclose($handle);
} else {
    echo "the application can not read the files";
}
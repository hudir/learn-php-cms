<?php

$file = 'example.txt';

$handle = fopen($file, 'w');

fclose($handle);

echo 123;

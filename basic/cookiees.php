<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php

echo "set and read cookies<br>";
echo "<br>";

$name = "someName";
$value = 100;
$expiration = time() + (60 * 60 * 24 * 7 * 4); // time of expiration

setcookie($name, $value, $expiration);

print_r($_COOKIE);
echo "<h1>";
if(isset($_COOKIE['someName'])) {
    echo $_COOKIE['someName'];
}
echo "</h1>";

?>

</body>
</html>









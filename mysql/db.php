<?php
$connection = mysqli_connect('localhost', 'root', '', 'loginapp');
if(!$connection) {
    echo "<br>Connect to DB error<br>";
}
?>
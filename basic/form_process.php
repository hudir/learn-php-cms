<?php

echo "How to use data from form - form data handler<br>";
echo "<br>";

if (isset($_POST['submit'])) {
    $username =$_POST['username'];
    echo $username."<br>";
    echo $_POST['password']."<br>";
    print_r($_POST);
    echo "<br>";

    $list=array("hudir");
    if(strlen($username) < 5) {
        echo "USername has to be longer than five";
    }
    if(in_array($username, $list)) {
        echo "<br>Welcome";
    }

}


?>

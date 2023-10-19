<?php

echo "How to use data from form<br>";
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

<form action="form.php" method="post">
    <input type="text" placeholder="Enter Username" name="username"/><br>
    <input type="password"  placeholder="Enter Password" name="password"/><br>
    <input type="submit" name="submit"/>

</form>
<br>
<h1>The extenal form</h1>
<form action="form_process.php" method="post">
    <input type="text" placeholder="Enter Username" name="username"/><br>
    <input type="password"  placeholder="Enter Password" name="password"/><br>
    <input type="submit" name="submit"/>

</form>
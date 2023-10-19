<?php
function readAllUsersAndPrint() {
    $query = "SELECT * FROM users;";
    global $connection;
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <pre>
                <?php
                print_r($row);
                echo "<br>";
                ?>
            </pre>
        <?php
    }
}
function showAllId(){
    global $connection;
    $query="SELECT * FROM users;";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc( $result)) {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function updateBaseOnId() {
    global $connection;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];

    mysqli_real_escape_string($connection, $username);
    mysqli_real_escape_string($connection, $password);

    if ( $username &&  $password) {
        echo $username. "<br>" . $password;
    } else {
        die("<br>These field cannot be blank<br>");
    }

    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hashFormat . $salt;
    $encript_password = crypt($password, $hashF_and_salt);

    $query = "UPDATE users SET username='$username', password='$encript_password' WHERE id=$id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query FAILED" .mysqli_error($connection));
    }
}

function register() {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    mysqli_real_escape_string($connection, $username);
    mysqli_real_escape_string($connection, $password);

    if ( $username && $password) {
        echo $username. "<br>" . $password;
    } else {
        die("<br>These field cannot be blank<br>");
    }

    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hashFormat . $salt;
    $encript_password = crypt($password, $hashF_and_salt);

    $query="INSERT INTO users(username, password) ";
    $query .= "VALUES ('$username', '$encript_password')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query FAILED" .mysqli_error($connection));
    } else {
        echo "Record Create";
    }
}

function deleteBaseOnId() {
    $id=$_POST['id'];
    $query = "DELETE FROM users WHERE id=$id";
    global $connection;
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query FAILED" .mysqli_error($connection));
    }
}
?>
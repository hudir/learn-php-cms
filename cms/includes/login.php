<?php include 'db.php';

if ( isset($_POST['login']) ) {
    $user_login_name = escape($_POST['username']);
    $user_login_password = escape($_POST['password']);

    $query = "SELECT * FROM users WHERE user_name = '{$user_login_name}'";

    $user_data = excuseMysqliQueryAndGetData($query);

    if(empty($user_data)) {
        echo "<h1>User Not Found</h1>";
    } else {
        foreach ( $user_data as $row ) {
            $user_id =  $row['user_id'];
            $user_name =  $row['user_name'];
            $user_password =  $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            $randSalt = $row['randSalt'];
        }

        $user_login_password = crypt($user_login_password, $user_password);

        if($user_name !== $user_login_name || $user_password !== $user_login_password) {
            echo "<h1>Wrong User Name or Password</h1>";
        } else {
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_role'] = $user_role;
            $_SESSION['user_image'] = $user_image;
            $_SESSION['user_password'] = $user_password;

            header("Location: ../admin");
        }
    }
}
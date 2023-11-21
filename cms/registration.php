<?php include "includes/db.php";
include "includes/header.php"; ?>

<?php
$msg = '';

if (isset($_POST['Register'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    $user_name = escape($user_name);
    $user_email = escape($user_email);
    $user_password = escape($user_password);
    $user_firstname = escape($user_firstname);
    $user_lastname = escape($user_lastname);

    if(!empty($user_name) && !empty($user_email) && !empty($user_password)) {
        $query = "SELECT randSalt From users;";
        $result = excuseMysqliQueryAndGetData($query);
        $randInt =  (string)rand(0, 9);
        $randSalt = ($result['0']['randSalt']).$randInt;

        $user_password = crypt($user_password, $randSalt);

        $query_insert_user = "INSERT INTO users (user_name, user_email, user_password, user_firstname, user_lastname, randSalt)";
        $query_insert_user .= " VALUES ('{$user_name}', '{$user_email}', '{$user_password}', '{$user_firstname}' , '{$user_lastname}' , '{$randSalt}');";

        excuseMysqliQuery($query_insert_user);

        $msg = "<h5 class='text-success text-center'>Your Registration has been submitted</h5>";
    } else {
        $msg = "<h5 class='text-danger text-center'>Fields cannot be empty</h5>";
    }

}

?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center"><?php echo _REGISTER; ?></h1>

                        <br/>
                        <?php echo $msg;?>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                            </div>
                            <br/><br/>
                            <div class="form-group">
                                <label for="user_firstname" class="sr-only">user firstname</label>
                                <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="<?php echo _FIRSTNAME; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname" class="sr-only">user lastname</label>
                                <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="<?php echo _LASTNAME; ?>">
                            </div>

                            <input type="submit" name="Register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

    <?php include "includes/footer.php"; ?>

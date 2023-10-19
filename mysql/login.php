<?php
include "db.php";
include "functions.php";
include "./includes/header.php";

// create new user
if(isset($_POST['Register'])) {
    register();
} elseif (isset($_POST['update'])) {
    updateBaseOnId();
} elseif (isset($_POST['delete'])) {
    deleteBaseOnId();
} elseif (isset($_POST['showAll'])) {
    readAllUsersAndPrint();
}
?>

<h1 class="text-center my-5">CRUD</h1>
<div class="container row mb-5">
    <div class="col-sm-6 text-center">
        <form  action="login.php" method="post">
            <h2 >Register</h2>
            <div class="form-group">
                <label for="username"  class="form-label">Username</label>
                <input type="text" name="username" class="from-control">
            </div>

            <div class="form-group">
                <label for="password"  class="form-label">Password</label>
                <input type="password" name="password" class="from-control">
            </div>

            <input type="submit" name="Register" value="Register" class="btn btn-primary">
        </form>
    </div>

    <div class="col-sm-6 text-center">
        <h2 >Read all Users</h2>
        <form  action="login.php" method="post">
            <input type="submit" name="showAll" value="Show Me" class="btn btn-primary">
        </form>
    </div>
</div>

<div class="row container">
    <div class="col-sm-6 text-center">
        <h2 >Update</h2>
        <form  action="login.php" method="post">
            <div class="form-group">
                <label for="username"  class="form-label">New Username</label>
                <input type="text" name="username" class="from-control">
            </div>

            <div class="form-group">
                <label for="password"  class="form-label">New Password</label>
                <input type="password" name="password" class="from-control">
            </div>

            <div class="form-group px-5 text-center">
                <label for=""  class="form-label">User ID to update</label>
                <select name="id" id="" class="form-select w-50 mx-auto">
                    <?php
                    showAllId();
                    ?>
                </select>
            </div>

            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </form>
    </div>

    <div class="col-sm-6 text-center">
        <h2 >Delete a User</h2>
        <form  action="login.php" method="post">
            <div class="form-group px-5  text-center">
                <label for=""  class="form-label ">User ID to delete</label>
                <select name="id" id="" class="form-select w-50 mx-auto">
                    <?php
                    showAllId();
                    ?>
                </select>
            </div>

            <input type="submit" name="delete" value="Delete User" class="btn btn-primary">
        </form>
    </div>
</div>

<?php include"./includes/footer.php";?>
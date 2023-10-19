<?php
if (isset($_POST['create_user'])) {
    $user_name = $_POST['user_name'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(user_name, user_role, user_firstname, user_lastname, user_email, user_image, user_password, randSalt) VALUES ('{$user_name}', '{$user_role}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}', 000, 0)";

    excuseMysqliQuery($query);
    header("Location: users.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_name">user name</label>
        <input id="user_name" type="text" name="user_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_firstname">user firstname</label>
        <input id="user_firstname" type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname">user_lastname</label>
        <input id="user_lastname" type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">user role</label>
        <select name='user_role' id='user_role'>
            <option defaultSelected >Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscribe">Subscribe</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_image">user image</label>
        <input id="user_image" type="file" name="user_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">user email</label>
        <input id="user_email" type="email" name="user_email" class="form-control">
    </div>

    <!--    <div class="form-group">-->
    <!--        <label for="post_content">Post Content</label>-->
    <!--        <textarea id="post_content" name="post_content" class="form-control" cols="30" rows="10"></textarea>-->
    <!--    </div>-->

    <div class="form-group">
        <input type="submit" name="create_user" value="Create User" class="btn btn-primary">
    </div>
</form>
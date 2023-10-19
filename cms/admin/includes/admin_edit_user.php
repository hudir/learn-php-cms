<?php
if (isset($_GET['id'])) {

    $the_edit_user_id = $_GET['id'];
    $query = "SELECT * FROM users WHERE user_id = $the_edit_user_id;";
    $select_user_query = excuseMysqliQueryAndGetData($query);

    foreach ($select_user_query as $row) {
        $user_name = $row['user_name'];
        $user_role = $row['user_role'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
    }

    $default_img = $user_image;

    if (isset($_POST['edit_user'])) {
        $user_name = $_POST['user_name'];
        $user_role = $_POST['user_role'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if(empty( $user_image )) {
            $user_image = $default_img;
        }

        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$the_edit_user_id}; ";
        excuseMysqliQuery($query);
        header("Location: users.php");
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_name">user name</label>
        <input id="user_name" type="text" name="user_name" class="form-control" value="<?php echo $user_name ?>">
    </div>

    <div class="form-group">
        <label for="user_firstname">user firstname</label>
        <input id="user_firstname" type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">user_lastname</label>
        <input id="user_lastname" type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname ?>">
    </div>

<!--    <div class="form-group">-->
<!--        <label for="user_role">user role</label>-->
<!--        <select name='user_role' id='user_role'>-->
<!--            --><?php
//            $query = "SELECT user_id, user_role FROM users;";
//            $user_categories = excuseMysqliQueryAndGetData($query);
//
//            foreach ($user_categories as $row) {
//                $user_role = $row['user_role'];
//                $user_id = $row['user_id'];
//                echo "
//            <option value='{$user_id}'>{$user_role}</option>
//        ";
//            }
//            ?>
<!--        </select>-->
<!--    </div>-->

    <div class="form-group">
        <label for="user_role">user role</label>
        <select name='user_role' id='user_role'>
            <?php
            if ($user_role == 'admin') {
                echo "  <option value='admin' selected='selected'>Admin</option>
                        <option value='subscribe'>Subscribe</option>";
            } else {
                echo "  <option value='admin' >Admin</option>
                        <option value='subscribe' selected='selected'>Subscribe</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="user_image">user image</label>
        <input id="user_image" type="file" name="user_image" class="form-control" >
    </div>

    <div class="form-group">
        <label for="user_email">user email</label>
        <input id="user_email" type="email" name="user_email" class="form-control" value="<?php echo $user_email ?>">
    </div>

    <!--    <div class="form-group">-->
    <!--        <label for="post_content">Post Content</label>-->
    <!--        <textarea id="post_content" name="post_content" class="form-control" cols="30" rows="10"></textarea>-->
    <!--    </div>-->

    <div class="form-group">
        <input type="submit" name="edit_user" value="Save Update" class="btn btn-primary">
    </div>
</form>
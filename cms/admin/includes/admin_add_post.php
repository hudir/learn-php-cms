<?php

if(isset($_POST['creat_post']) && $_SESSION['user_id']) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_SESSION['user_id'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');


    $post_img = $_FILES['post_img']['name'];
    $post_img_temp = $_FILES['post_img']['tmp_name'];

    move_uploaded_file($post_img_temp, "../images/$post_img");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}','{$post_status}')";

    excuseMysqliQuery($query);

    $post_id = getNewInsertId();
    echo "<p class='bg-success'>Post Created. <a href='../post.php?post_id={$post_id}'> View Post</a>  <span>or</span> <a href='posts.php'> See All Posts</a></p>";
//        header("Location: posts.php");
}

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Title</label>
        <input id="post_title" type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category_id">Category</label><br>
        <select name='post_category_id' id='post_category_id'>
            <?php
            $query = "SELECT cat_id, cat_title FROM categories;";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "
            <option value='{$cat_id}'>{$cat_title}</option>
        ";
            }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_status'>Status</label><br/>
        <select name='post_status' id='post_status'>
            <option value='draft' selected='selected'>draft</option>
            <option value='published'>published</option>";
        </select>
    </div>

    <div class="form-group">
        <label for="post_img">Add Image</label>
        <input id="post_img" type="file" name="post_img" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input id="post_tags" type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea id="summernote" name="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="creat_post" value="Publish Post" class="btn btn-primary">
    </div>
</form>
<?php

if (isset($_GET['edit_post_id'])) {
    global $connection;
    $the_edit_post_id = $_GET['edit_post_id'];
    $query = "SELECT * FROM posts WHERE post_id = $the_edit_post_id;";
    $select_post_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_post_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

    $default_img = $post_image;

    if (isset($_POST['edit_post'])) {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
//        $post_date = format('d-m-Y');
        $post_comment_count = 0;

        $post_img = $_FILES['post_img']['name'];
        $post_img_temp = $_FILES['post_img']['tmp_name'];

        move_uploaded_file($post_img_temp, "../images/$post_img");

        if (empty($post_img)) {
            $post_img = $default_img;
        }

        $query = "UPDATE posts SET ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_date = '{$post_date}', ";
        $query .= "post_image = '{$post_img}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_comment_count = '{$post_comment_count}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$the_edit_post_id} ";

        excuseMysqliQuery($query);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?post_id={$post_id}'> View Post</a>  <span>or</span> <a href='posts.php'> Edit More Posts</a></p>";
//        header("Location: posts.php");
    }
}
?>

<form action='' method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='post_title'>Title</label>
        <input id='post_title' type='text' name='post_title' class='form-control' value='<?php echo $post_title ?>'>
    </div>

    <div class='form-group'>
        <label for='post_category_id'>Category</label><br/>
        <select name='post_category_id' id='post_category_id'>
            <?php
            $query = "SELECT cat_id, cat_title FROM categories;";
            $select_categories = excuseMysqliQueryAndGetData($query);

            foreach ($select_categories as $row) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                if ($cat_id === $post_category) {
                    echo "
            <option value='{$cat_id}' selected='selected'>{$cat_title}</option>
        ";
                } else {
                    echo "
            <option value='{$cat_id}'>{$cat_title}</option>
        ";
                }
            }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='post_status'>Status</label><br/>
        <select name='post_status' id='post_status'>
            <?php
            if ($post_status === 'draft') {
                $post_status_other = 'published';
            } else {
                $post_status_other = 'draft';
            }
            echo "
            <option value='{$post_status}' selected='selected'>{$post_status}</option>
            <option value='{$post_status_other}'>{$post_status_other}</option>";
            ?>
        </select>
    </div>

    <div class='form-group'>
        <img src='../images/<?php echo $post_image ?>' width='100'>
        <label for='post_img'>Change Image</label>
        <input id='post_img' type='file' name='post_img' class='form-control'>
    </div>

    <div class='form-group'>
        <label for='post_tags'>Tags</label>
        <input id='post_tags' type='text' name='post_tags' class='form-control' value='<?php echo $post_tags ?>'>
    </div>

    <div class='form-group'>
        <label for='summernote'>Post Content</label>
        <textarea id='summernote' name='post_content' class='form-control' cols='30' rows='8'><?php echo $post_content ?></textarea>
    </div>

    <div class='form-group'>
        <label>Created Date: </label>
        <span><?php echo $post_date ?></span>
    </div>

    <div class='form-group'>
        <input type='submit' name='edit_post' value='Publish Post' class='btn btn-primary'>
    </div>
</form>

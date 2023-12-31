<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';
?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['post_id'])) {
                $p_id = (int)escape($_GET['post_id']);

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$p_id}";
                excuseMysqliQuery($view_query);

                $query = "SELECT * FROM posts WHERE post_id = {$p_id};";
                $select_posts_query = excuseMysqliQueryAndGetData($query);

                foreach ($select_posts_query as $row) {
                    $post_title = $row['post_title'];
                    $post_author_id = $row['post_author'];

                    $get_user_query = "SELECT * FROM users WHERE user_id = {$post_author_id}";
                    $post_author = excuseMysqliQueryAndGetData($get_user_query)[0]['user_name'];

                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_views_count = $row['post_views_count'];
                    ?>

<!--                    <h1 class="page-header">-->
<!--                        Page Heading-->
<!--                        <small>Secondary Text</small>-->
<!--                    </h1>-->

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>

                <?php }
            } else {
                header('Location: index.php');
            }
            ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['create_comment'])) {
                $comment_post_id = escape($p_id);
                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                    excuseMysqliQuery($query);

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$p_id};";
                    excuseMysqliQuery($query);
                    redirect('post.php?post_id=' . $p_id);
                } else {
                    echo "<script>alert('Field can not be empty')</script>";
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input required type="text" class="form-control" name="comment_author" id="comment_author"/>
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input required type="text" class="form-control" name="comment_email" id="comment_email"/>
                    </div>

                    <div class="form-group">
                        <label for="comment_content">Your Comment:</label>
                        <textarea required class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php


            $query = "SELECT * FROM comments WHERE comment_post_id = {$p_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
            $comment_data = excuseMysqliQueryAndGetData($query);

            if ($comment_data) {
                foreach ($comment_data as $row) {
                    $comment_date = $row["comment_date"];
                    $comment_content = $row["comment_content"];
                    $comment_author = $row["comment_author"];

                    echo "
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'>{$comment_author}
                            <small>{$comment_date}</small>
                        </h4>
                        {$comment_content}
                    </div>
                </div>
                
                ";
                }
            }

            ?>

            <!-- Comment -->
            <hr>
            <small>This post has been read for <?php echo $post_views_count; ?> times</small>

        </div>

        <?php
        include 'includes/sidebar.php'
        ?>
    </div>
    <!-- /.row -->
    <hr>

<?php
include 'includes/footer.php'
?>
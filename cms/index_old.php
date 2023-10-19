<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';

global $connection;
$query = "SELECT * FROM posts;";
$select_all_posts_query = excuseMysqliQueryAndGetData($query);

?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            foreach ($select_all_posts_query as $row) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_content = substr($post_content, 0, 200);
                $post_status = $row['post_status'];

                if ($post_status === 'published') {
                    ?>
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2 class="d-inline">
                        <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_post.php?author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?post_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php }
            } ?>
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
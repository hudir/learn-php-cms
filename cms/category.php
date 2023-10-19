<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';

if(isset($_GET['cat_id'])) {
global $connection;
    $cat_id = $_GET['cat_id'];
    $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id};";
    $select_category_posts_query = mysqli_query($connection, $query);
    confirmQuery($select_category_posts_query);
}


?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            while ($row = mysqli_fetch_assoc($select_category_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_content = substr($post_content, 0 , 200)
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span
                        class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

                <?php } ?>
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
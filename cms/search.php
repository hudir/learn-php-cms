<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';

global $connection;
?>

    <!-- Page Content -->
    <div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            if (isset($_POST['submit'])) {
                $search = escape(trim($_POST['search']));

                if (!$search) {
                    redirect('/demo/cms/');
                }

                $_SESSION['last_search'] = $search;

                $result = [];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ;";
                $search_tags = excuseMysqliQueryAndGetData($query);
                if ($search_tags) {
                    $result = array_merge($search_tags);
                }

                $query = "SELECT * FROM posts WHERE post_title LIKE '%$search%' ;";
                $search_title = excuseMysqliQueryAndGetData($query);
                if ($search_title) {
                    $result = array_merge($result, $search_title);
                }

                $query = "SELECT * FROM posts WHERE post_content LIKE '%$search%' ;";
                $search_content = excuseMysqliQueryAndGetData($query);
                if ($search_content) {
                    $result = array_merge($result, $search_content);
                }

//                filter array to take out repeated post
                $exist_id = [];
                $filtered_result = [];

                foreach ($result as $row) {
                    $current_post_id = $row['post_id'];
                    if (array_key_exists($current_post_id, $exist_id)) {
                        continue;
                    } else {
                        // high light matched content
                        $row['post_title'] = str_replace($search, addHighLight($search), $row['post_title']);
                        $row['post_content'] = str_replace($search, addHighLight($search), $row['post_content']);
                        $row['post_tags'] = str_replace($search, addHighLight($search), $row['post_tags']);

                        $filtered_result[] = $row;
                        $exist_id[] = $current_post_id;
                    }
                }

                if (count($filtered_result) === 0) {
                    echo "<h1>No RESULT for: {$search}</h1>";
                } else {
                    echo "<h3>Search RESULT for: {$search}</h3>";

                    $authorMap = getAuthorMap();

                    foreach ($filtered_result as $row) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_id = $row['post_id'];
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="/demo/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <span"><?php
                                if (array_key_exists($post_author, $authorMap)) {
                                    echo $authorMap[$post_author];
                                }
                                ?></span>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                    <?php }
                }
            } else {
                redirect('/demo/cms/');
            }
            ?>
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
<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';
include 'includes/db_class.php';

?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            $post_pagination->run();

            echo $post_pagination->current_page_template;
;


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

    <?php

    ?>

<?php

include 'includes/db.php';
include 'includes/header.php';
include 'includes/navigation.php';
require_once 'includes/db_class.php';
?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if (isset($_GET['cat_id'])) {
                    global $connection;
                    $cat_id = escape($_GET['cat_id']);

                    $categroy_pagination = new Pagination($connection, " WHERE post_category_id = {$cat_id}", 9999);

                    $categroy_pagination->run();
                    echo $categroy_pagination->current_page_template;
                }

                ?>
            </div>

            <?php
            include 'includes/sidebar.php';
            ?>
        </div>

    </div>
<?php
include 'includes/footer.php'
?>
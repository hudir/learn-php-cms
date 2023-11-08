<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Hudir's Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse d-flex justify-content-between" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = 'SELECT * FROM categories;';
                $select_all_categories_query = excuseMysqliQueryAndGetData($query);
                foreach ($select_all_categories_query as $row) {
                    echo "<li><a href='category.php?cat_id={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                }

                ?>
            </ul>

            <ul class="nav navbar-nav ">
                <?php

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                    echo "<li class='p-5'>
                              <a href='./admin/index.php'>Admin</a>
                          </li>";

                }
                if (!isset($_SESSION['user_email'])) {
                    echo " <li class='p-5'>
                    <a href='./registration.php'>Registration</a>
                </li>";
                } else {
                    echo " <li class='p-5'>
                    <a href='includes/logout.php'>Logout</a>
                </li>";

                }

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' && isset($_GET['post_id'])) {
                    echo " <li>
                    <a class='text-warning' href='admin/posts.php?source=edit_post&edit_post_id={$_GET['post_id']}'>Edit Post</a>
                        </li>";
                }
                ?>

                <!--                <li>-->
                <!--                    <a href="#">Contact</a>-->
                <!--                </li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

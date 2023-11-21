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
            <a class="navbar-brand" href="/demo/cms/index">Hudir's Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse d-flex justify-content-between" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                $current_cat_id = $_GET['cat_id'] ?? null;
                $query = 'SELECT * FROM categories;';
                $select_all_categories_query = excuseMysqliQueryAndGetData($query);
                foreach ($select_all_categories_query as $row) {
                    $cat_id = $row['cat_id'];
                    $activeClass = '';
                    if ($cat_id == $current_cat_id) {
                        $activeClass = 'active';
                    }
                    echo "<li class='{$activeClass}'><a href='/demo/cms/category/{$row['cat_id']}'>{$row['cat_title']}</a></li>";
                }

                ?>
            </ul>

            <form class="navbar-form navbar-right" id="langForm"
                  role="form" method="get">
                <div class="form-group">
                    <select name="lang" class="form-control" onchange="changeLang(event)">
                        <option value="en"
                            <?php if($_SESSION['lang'] == 'en') { echo "selected='selected'";} ?>
                        >English</option>
                        <option value="de" <?php if($_SESSION['lang'] == 'de') { echo "selected='selected'";} ?>>Deutsche</option>
                        <option value="cn" <?php if($_SESSION['lang']  == 'cn') { echo "selected='selected'";} ?>>简体中文</option>
                    </select>
                </div>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <?php
                $pageName = basename($_SERVER['PHP_SELF']);


                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                    echo "<li class='p-5'>
                              <a href='/demo/cms/admin/index.php'>Admin</a>
                          </li>";
                }
                if (!isset($_SESSION['user_email'])) {
                    $activeClass = '';
                   if($pageName === 'registration.php') {
                    $activeClass = 'active';
                   }
                    echo " <li class='p-5 {$activeClass}'>
                    <a href='/demo/cms/registration'>Registration</a>
                </li>";
                } else {
                    echo " <li class='p-5'>
                    <a href='includes/logout.php'>Logout</a>
                </li>";
                }

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' && isset($_GET['post_id'])) {
                    echo " <li>
                    <a class='text-warning' href='/demo/cms/admin/posts.php?source=edit_post&edit_post_id={$_GET['post_id']}'>Edit Post</a>
                        </li>";
                }

                $activeClass = '';
                if($pageName === 'contact.php') {
                    $activeClass = 'active';
                }
                echo "<li class='{$activeClass}'>
                    <a href='/demo/cms/contact'>Contact</a>
                </li>";
                ?>
            </ul>



        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


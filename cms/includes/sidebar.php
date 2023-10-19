<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login From Well -->
    <?php
    if (!isset($_SESSION['user_email'])) {
        echo "
        <div class='well'>
           <h4>User Login</h4>
           <form action='includes/login.php' method='post'>
                 <div class='form-group'>
                     <input name='username' type='text' class='form-control'          placeholder='Enter Username'>
                 </div>

                 <div class='input-group'>
                     <input name='password' type='password' class='form-control'          placeholder='Enter password'>
                     <span class='input-group-btn'>
                             <button type='submit' name='login' class='btn btn-primary'          type='submit'>Login</button>
                         </span>
                 </div>
             </form>
                     <!-- /.input-group -->
         </div>
        ";
    }

    ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    global $connection;
                    $query = 'SELECT * FROM categories LIMIT 8;';
                    $select_categories_query_sidebar = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_query_sidebar)) {
                        echo "<li><a href='category.php?cat_id={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!--            <div class="col-lg-6">-->
            <!--                <ul class="list-unstyled">-->
            <!--                    <li><a href="#">Category Name</a>-->
            <!--                    </li>-->
            <!--                    <li><a href="#">Category Name</a>-->
            <!--                    </li>-->
            <!--                    <li><a href="#">Category Name</a>-->
            <!--                    </li>-->
            <!--                    <li><a href="#">Category Name</a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <?php include 'widget.php';
    ?>
</div>
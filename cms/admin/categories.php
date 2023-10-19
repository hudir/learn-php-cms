<?php include 'includes/admin_header.php'; ?>
    <div id="wrapper">
<?php include 'includes/admin_navigation.php'; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Category Page
                        <small><?php echo $_SESSION['user_name'] ?></small>
                    </h1>

                    <div class="col-xs-6">

                        <?php insert_categories(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input id="cat_title" type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                            </div>
                        </form>

                       <?php update_category(); ?>

                    </div>

                    <div class="col-xs-6">
                        <table class="table  table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            print_all_categories();
                            delete_category_by_id();
                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>
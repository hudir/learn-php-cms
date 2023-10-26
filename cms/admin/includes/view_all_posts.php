<form action="" method="post">
    <table class="table  table-hover table-bordered">

        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_option" id="">
                <option value="">Select Options</option>
                <option value="Publish">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
                <option value="Clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="apply" class="btn btn-success" value="Apply"/>
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>

        <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"/></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>
        </tr>
        </thead>
        <tbody>
        <?php
        global $connection;
        $query = 'SELECT * FROM posts ORDER BY post_id DESC;';
        $select_posts_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts_query)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_views_count = $row['post_views_count'];

            $query_cate = "SELECT cat_id, cat_title FROM categories WHERE cat_id = {$post_category};";
            $selected_categories = mysqli_query($connection, $query_cate);
            confirmQuery($selected_categories);
            while ($row = mysqli_fetch_assoc($selected_categories)) {
                $cat_title = $row['cat_title'];
                echo "<tr>
                                         <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'/></td>
                                         
                                         <td>{$post_id}</td>
                                         <td>{$post_author}</td>
                                         <td><a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>
                                         <td>{$cat_title}</td>
                                         <td>{$post_status}</td>
                                         <td><img src='../images/$post_image' class='img-responsive' width='100'/></td>
                                         <td>{$post_tags}</td>
                                         <td><a href='comments.php?post_id={$post_id}'>{$post_comments}</a></td>
                                         <td>{$post_date}</td> 
                                         <td><a href='posts.php?source=edit_post&edit_post_id={$post_id}' class='btn btn-warning'>Edit</a> </td>                                                                
                                         <td><a onClick=\"javascript: return confirm('Delete this post and all comments, Are you sure you want delete?')  \" href='posts.php?delete_post={$post_id}' class='btn btn-danger'>Delete</a></td>  
                                         <td>{$post_views_count}
                                         <br/>
                                         <a onClick=\"javascript: return confirm('Reset this post view count, Are you sure you want reset it to 0?')  \" href='posts.php?reset_view_count={$post_id}' class=''>Reset</a>
                                         </td> 
                                      </tr>";
            }
        }
        if (isset($_GET['reset_view_count'])) {
            $the_post_id = $_GET['reset_view_count'];

            excuseMysqliQueryAndUpdateByID('posts', 'post_views_count', 0, 'post_id', $the_post_id);

            header("Location: posts.php");
        }

        if (isset($_GET['delete_post'])) {
            $the_post_id = $_GET['delete_post'];

            $query = "DELETE FROM posts WHERE post_id = {$the_post_id};";
            excuseMysqliQuery($query);

            $query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id};";
            excuseMysqliQuery($query);
            header("Location: posts.php");
        }

        if (isset($_POST['checkBoxArray'])) {
            $bulk_option = $_POST['bulk_option'];
            if ($bulk_option) {
                foreach ($_POST['checkBoxArray'] as $cBValue_id) {
                    switch ($bulk_option) {
                        case 'Draft':
                            excuseMysqliQueryAndUpdateByID('posts', 'post_status', 'draft', 'post_id', $cBValue_id);
                            break;
                        case 'Publish':
                            excuseMysqliQueryAndUpdateByID('posts', 'post_status', 'published', 'post_id', $cBValue_id);
                            break;
                        case 'Delete':
                            excuseMysqliQueryAndDeleteByID('posts', 'post_id', $cBValue_id);
                            break;
                        case 'Clone':
                            global $connection;
                            $query = "SELECT * FROM posts WHERE post_id = '{$cBValue_id}';";
                            $select_new_posts_query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_array($select_new_posts_query)) {
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_category_id = $row['post_category_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comments = $row['post_comment_count'];
                                $post_date = $row['post_date'];
                                $post_content = $row['post_content'];
                            }
                            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                            excuseMysqliQuery($query);
                            break;
                    }
                }
                header('Location: posts.php');
            }
        }
        ?>
        </tbody>
    </table>

</form>
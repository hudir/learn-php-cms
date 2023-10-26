<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapproved</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php

    if ((isset($_GET['post_id']))) {
        $p_id = $_GET['post_id'];
        $query = "SELECT * FROM comments WHERE comment_post_id = $p_id;";
    } else {
        $query = 'SELECT * FROM comments;';
    }
    $select_comments_query = excuseMysqliQueryAndGetData($query);

    foreach ($select_comments_query as $row) {
        $comment_id = $row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_post_id = $row['comment_post_id'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        $query_cate = "SELECT post_title FROM posts WHERE post_id = $comment_post_id;";
        $selected_categories = excuseMysqliQueryAndGetData($query_cate);

        $post_title = $selected_categories[0]['post_title'];

        echo "<tr>
                                         <td>{$comment_id}</td>
                                         <td>{$comment_author}</td>
                                         <td>{$comment_content}</td>
                                         <td>{$comment_email}</td>
                                         <td>{$comment_status}</td>
                                         <td><a href='../post.php?post_id=$comment_post_id'>{$post_title}</a></td>
                                         <td>{$comment_date}</td> 
                                         <td><a href='comments.php?source=approve_comment&comment_id={$comment_id}' class='btn btn-primary'>Approve</a> </td>      
                                         <td><a href='comments.php?source=unapprove_comment&comment_id={$comment_id}' class='btn btn-primary'>Unapprove</a> </td>      
                                                                                             
                                         <td><a href='comments.php?delete_comment={$comment_id}' class='btn btn-danger'>Delete</a></td>   
                                      </tr>";
    }

    if (isset($_GET['delete_comment'])) {
        $the_comment_id = $_GET['delete_comment'];

        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id};";
        excuseMysqliQuery($query);

        header("Location: comments.php");
    }

    if (isset($_GET['source'])) {
        if ($_GET['source'] === "unapprove_comment") {
            $the_comment_id = $_GET['comment_id'];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id};";
        } else {
            if ($_GET['source'] === "approve_comment") {
                $the_comment_id = $_GET['comment_id'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id};";
            }
        }
        excuseMysqliQuery($query);
        header("Location: comments.php");
    }

    ?>
    </tbody>
</table>
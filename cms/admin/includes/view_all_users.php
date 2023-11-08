<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Edit</th>
        <th>Update Admin</th>
        <th>Update Subscriber </th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = 'SELECT * FROM users;';
    $select_users_query = excuseMysqliQueryAndGetData($query);

    foreach ($select_users_query as $row) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

//        $comment_date = $row['comment_date'];

//        $query_cate = "SELECT post_title FROM posts WHERE post_id = $comment_post_id;";
//        $selected_categories = excuseMysqliQueryAndGetData($query_cate);
//        $post_title = $selected_categories[0]['post_title'];

//        <td><a href='../post.php?post_id=$comment_post_id'>{$post_title}</a></td>
//                                         <td>{$comment_date}</td>
//                                         <td><a href='comments.php?source=approve_comment&comment_id={$comment_id}' class='btn btn-primary'>Approve</a> </td>
//                                         <td><a href='comments.php?source=unapprove_comment&comment_id={$comment_id}' class='btn btn-primary'>Unapprove</a> </td>

        echo "<tr>
                                         <td>{$user_id}</td>
                                         <td>{$user_name}</td>
                                         <td>{$user_firstname}</td>
                                         <td>{$user_lastname}</td>
                                         <td>{$user_email}</td>
                                         <td>{$user_role}</td>
                                         <td><a href='users.php?source=edit_user&id={$user_id}' class='btn btn-warning'>Ediit</a></td>
                                          <td><a href='users.php?source=admin&id={$user_id}' class='btn btn-primary'>Admin</a></td>
                                           <td><a href='users.php?source=subscriber&id={$user_id}' class='btn btn-primary'>Subscriber</a></td>
                                         <td><a onClick=\"javascript: return confirm('Delete this user: {$user_name},  will also delete all post from this user, Are you sure you want delete?')  \" href='users.php?delete_user={$user_id}' class='btn btn-danger'>Delete</a></td>
                                         </tr>";
    }

    if (isset($_GET['delete_user'])) {
        $the_user_id = $_GET['delete_user'];

        excuseMysqliQueryAndDeleteByID('users', 'user_id', $the_user_id);
        excuseMysqliQueryAndDeleteByID('posts', 'post_author', $the_user_id);

        header("Location: users.php");
    }

    if (isset($_GET['source'])) {
        $the_user_id = $_GET['id'];
        $the_user_role = $_GET['source'];

        $query = "UPDATE users SET user_role = '{$the_user_role}' WHERE user_id = {$the_user_id};";

        excuseMysqliQuery($query);
        header("Location: users.php");
    }

    ?>
    </tbody>
</table>
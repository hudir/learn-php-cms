<?php

function redirect($location) {
    return header('Location:' . $location);
}

function update_category()
{
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        $query = "SELECT cat_id, cat_title FROM categories WHERE cat_id={$cat_id}";
        $select_categories_idx = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_categories_idx)) {
            $cat_title = $row['cat_title'];
            echo '
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input id="cat_title" text" name="update_category" class="form-control" value="' . $cat_title . '">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit_update_category" value="Update Category" class="btn btn-warning">
                            </div>
                        </form>';
        }

        if (isset($_POST['submit_update_category'])) {
            $update_cat_title = $_POST['update_category'];
            $query_update = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id={$cat_id};";
            $delete_category = mysqli_query($connection, $query_update);
            if (!$delete_category) {
                die('QUERY FAILED' . mysqli_error($connection));
            } else {
                header("Location: categories.php");
            }
        }
    }
}

function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES('$cat_title');";
            $insert_add_new_category = mysqli_query($connection, $query);
            if (!$insert_add_new_category) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function print_all_categories() {
    global $connection;
    $query = 'SELECT * FROM categories;';
    $select_categories_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
                                         <td>{$cat_id}</td>
                                         <td>{$cat_title}</td>
                                         <td><a href='categories.php?edit={$cat_id}' class='btn-warning btn-xs'>Edit</a> </td>
                                         <td><a href='categories.php?delete={$cat_id}' class='btn-danger btn-xs'>X</a></td>
                                      </tr>";
    }
}

function delete_category_by_id()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_del = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$cat_id_del};";
        $delete_category = mysqli_query($connection, $query);
        if (!$delete_category) {
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("Location: categories.php");
        }
    }
}


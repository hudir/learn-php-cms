<?php

class DB
{
    var $connection;

    function setConnection($para)
    {
        $this->connection = $para;
    }

    function __construct()
    {
        $db['db_host'] = 'localhost';
        $db['db_user'] = 'root';
        $db['db_pass'] = '';
        $db['db_name'] = 'cms';

        foreach ($db as $key => $value) {
            define(strtoupper($key), $value);
        }

        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    function confirmQuery($query)
    {
        if (!$query) {
            die('QUERY FAILED' . mysqli_error(this->$connection));
        }
    }

    function excuseMysqliQuery($query)
    {
        mysqli_query(this->$connection, $query);
        confirmQuery($query);
    }

    function excuseMysqliQueryAndGetData($query, $err = true)
    {
        $result = mysqli_query(this->$connection, $query);
        if (!$query && $err) {
            die('QUERY FAILED' . mysqli_error(this->$connection));
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }

            if (empty($data)) {
                return false;
            } else {
                return $data;
            }
        }
    }

    function excuseMysqliQueryAndGetCounts($table, $queryExtra = '')
    {
        $query = "SELECT * FROM {$table} ";
        if (strlen($queryExtra) > 0) {
            $query .= $queryExtra;
        }
        $result = mysqli_query(this->$connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error(this->$connection));
        } else {
            return mysqli_num_rows($result);
        }
    }

    function excuseMysqliQueryAndGetAllData($table, $queryExtra = '')
    {
        $query = "SELECT * FROM {$table} ";
        if (strlen($queryExtra) > 0) {
            $query .= $queryExtra;
        }
        return $this->excuseMysqliQueryAndGetData($query);
    }

    function excuseMysqliQueryAndUpdateByID($table, $column, $newValue, $id_column, $id)
    {
        $query = "UPDATE {$table} SET {$column} = '{$newValue}' WHERE {$id_column} = {$id} ";
        echo $query;
        mysqli_query(this->$connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error(this->$connection));
        }
    }

    function excuseMysqliQueryAndDeleteByID($table, $id_column, $id)
    {
        $query = "DELETE FROM {$table} WHERE {$id_column} = {$id} ;";
        mysqli_query(this->$connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error(this->$connection));
        }
    }

    function getNewInsertId()
    {
        return mysqli_insert_id(this->$connection);
    }
}




class Pagination extends DB
{
    var $max_num_pro_page = null;

    var $sum_of_all_item = null;

    var $page_num = null;

    var $page_name = null;

    var $table_name = null;

    var $data = null;

    var $current_page = null;

    var $processed_data = null;

    var $current_page_template = null;
    var $current_buttons_template = null;
    
    function run() {
        this->get_current_page();
        this->gen_template();
    }
    
    function init($table_name = 'posts', $max_num_pro_page = 10, $main_url = 'index.php', $page_name='page') {
        $this->table_name = $table_name;
        this->get_count($table_name);
        this->get_all_data($table_name);
        this->set_max_num_pro_page($max_num_pro_page);
        this->set_page_nums();
        this->set_page_name($page_name);
        this->main($main_url);
        this->gen_template();
    }
    
    function get_current_page() {

        if(isset($_GET[$this->page_name])) {
            $current_page_name = (int)$_GET[$this->page_name];
        } else {
            $current_page_name = 0;
        }

        return (int)substr($current_page_name, -1);
    }
    function get_all_data($table)
    {
        if ($table) {
            $this->data = $this->excuseMysqliQueryAndGetAllData($table);
        } else {
            $this->data = $this->excuseMysqliQueryAndGetAllData($this->table_name);
        }
    }

    function get_count($table, $queryExtra = '')
    {
        $this->sum_of_all_item = this->excuseMysqliQueryAndGetCounts($table, $queryExtra);
    }

    function set_max_num_pro_page($num)
    {
        $this->max_num_pro_page = $num;
    }

    function set_page_nums()
    {
        $this->page_num = ceil($this->sum_of_all_item / $this->max_num_pro_page);
    }

    function set_page_name($name)
    {
        $this->page_name = $name;
    }

    function main($main_url)
    {
        $buttons = "<ul class='pager'>";

        $page_data = [];

        for ($i = 0; $i < $this->page_num; $i++) {
            $buttons .= "<li><a herf='$main_url?$this->page_name={$i}'>{$i}</a></li>";

            $current_page_data = [];
            $start = $i * $this->max_num_pro_page;
            $end = ($i + 1) * $this->max_num_pro_page;

            for ($y = $start; $y < $end; $y++) {
                if(!$this->data[$y]) {
                    break;
                }
                $current_page_data[] = $this->data[$y];
            }

            $current_page_name = $this->page_name . (string)$i;
            $page_data[$current_page_name] = $current_page_data;
        }

        $buttons .= "</ul>";

        $processed_data = array('page_data'=>$page_data, 'buttons'=> $buttons);
        $this->processed_data = $processed_data;
        $this->current_buttons_template = $buttons;
    }

    function gen_template() {
        $temp='';

        $current_page = $this->current_page;
        $current_page_name = $this->page_name . $current_page;
        $current_page_data = $this->result['page_data'][$current_page_name];
        foreach ($current_page_data as $row) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_content = substr($post_content, 0, 200);
            $post_status = $row['post_status'];

            if ($post_status === 'published') {
                $temp .= "
<!-- First Blog Post -->
<h1 class='d-inline'>
    <a href='post.php?post_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a>
</h1>
<p class='lead'>
    by
    <a href='author_post.php?author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>'><?php echo $post_author; ?></a>
</p>
<p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date; ?></p>
<hr>
<a href='post.php?post_id=<?php echo $post_id; ?>'>
    <img class='img-responsive' src='images/<?php echo $post_image; ?>' alt=''>
</a>
<hr>
<p><?php echo $post_content; ?></p>
<a class='btn btn-primary' href='post.php?post_id=<?php echo $post_id; ?>'>Read More <span
        class='glyphicon glyphicon-chevron-right'></span></a>

<hr>";
            }
        }
        $this->current_page_template = $temp;
    }
}

$post_pagination = new Pagination();
$post_pagination.init();


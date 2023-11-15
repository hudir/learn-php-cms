<?php

class DB
{
    var $connection = null;

    function setConnection($para)
    {
        $this->connection = $para;
    }

//    function __construct()
//    {
//        if (!$this->connection) {
//            $db['db_host'] = 'localhost';
//            $db['db_user'] = 'root';
//            $db['db_pass'] = '';
//            $db['db_name'] = 'cms';
//
//            foreach ($db as $key => $value) {
//                define(strtoupper($key), $value);
//            }
//
//            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//        }
//    }

    function confirmQuery($query)
    {
        if (!$query) {
            die('QUERY FAILED' . mysqli_error($this->connection));
        }
    }

    function excuseMysqliQuery($query)
    {
        mysqli_query($this->connection, $query);
        confirmQuery($query);
    }

    function excuseMysqliQueryAndGetData($query, $err = true)
    {
        $result = mysqli_query($this->connection, $query);
        if (!$query && $err) {
            die('QUERY FAILED' . mysqli_error($this->connection));
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
        $result = mysqli_query($this->connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error($this->connection));
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
        mysqli_query($this->connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error($this->connection));
        }
    }

    function excuseMysqliQueryAndDeleteByID($table, $id_column, $id)
    {
        $query = "DELETE FROM {$table} WHERE {$id_column} = {$id} ;";
        mysqli_query($this->connection, $query);
        if (!$query) {
            die('QUERY FAILED' . mysqli_error($this->connection));
        }
    }

    function getNewInsertId()
    {
        return mysqli_insert_id($this->connection);
    }
}

class Pagination extends DB
{
    private $max_num_pro_page = null;

    private $sum_of_all_item = null;

    private $page_num = null;

    private $page_name = null;

    private $table_name = null;

    private $main_url = null;

    private $data = null;

    private $all_users = null;

    private $current_page = null;

    private $processed_data = null;

    var $current_page_template = null;
    var $current_buttons_template = null;

    function run()
    {
        $this->get_current_page();
        $this->gen_template();
        $this->gen_buttons();
    }

    function __construct(
        $db,
        $data_limit = '',
        $max_num_pro_page = 5,
        $table_name = 'posts',
        $main_url = 'index.php',
        $page_name = 'page',
        $start_page
        = 0
    ) {
        $this->setConnection($db);
        $this->table_name = $table_name;
        $this->get_count($table_name, $data_limit);
        $this->get_all_data($table_name, $data_limit);
        $this->set_max_num_pro_page($max_num_pro_page);
        $this->set_page_nums();
        $this->set_page_name($page_name);
        $this->current_page = $start_page;
        $this->main_url = $main_url;
        $this->main();
        $this->gen_template();
    }

    private function get_current_page()
    {
        if (isset($_GET[$this->page_name])) {
            $current_page_name = (int)$_GET[$this->page_name];
        } else {
            $current_page_name = 0;
        }

        $this->current_page = $current_page_name;
        return $this->current_page;
    }

    private function get_all_data($table, $data_limit = '')
    {
        if ($data_limit) {
            $table = $table . $data_limit;
        }
        if ($table) {
            $this->data = $this->excuseMysqliQueryAndGetAllData($table);
        } else {
            $this->data = $this->excuseMysqliQueryAndGetAllData($this->table_name);
        }

        // Get users map
        $allUser = $this->excuseMysqliQueryAndGetAllData('users');
        foreach ($allUser as $userObj) {
            $userId = $userObj['user_id'];
            $userName = $userObj['user_name'];
            $this->all_users[$userId] = $userName;
        }
    }

    private function get_count($table, $queryExtra = '')
    {
        $this->sum_of_all_item = $this->excuseMysqliQueryAndGetCounts($table, $queryExtra);
    }

    private function set_max_num_pro_page($num)
    {
        $this->max_num_pro_page = $num;
    }

    private function set_page_nums()
    {
        $this->page_num = ceil($this->sum_of_all_item / $this->max_num_pro_page);
    }

    private function set_page_name($name)
    {
        $this->page_name = $name;
    }

    private function main()
    {
        $buttons = "<ul class='pager'>";
        $main_url = $this->main_url;

        $page_data = [];

        for ($i = 0; $i < $this->page_num; $i++) {
            $cu_page_num = $i + 1;
            $is_current_page = $this->current_page === $i;
            if ($is_current_page) {
                $buttons .= "<li><a class='btn btn-primary' href='{$main_url}?{$this->page_name}={$i}' >{$cu_page_num}</a></li>";
            } else {
                $buttons .= "<li><a class='btn' href='{$main_url}?{$this->page_name}={$i}' >{$cu_page_num}</a></li>";
            }

            $current_page_data = [];
            $start = $i * $this->max_num_pro_page;
            $end = ($i + 1) * $this->max_num_pro_page - 1;

            for ($y = $start; $y < $end; $y++) {
                if (!array_key_exists($y, $this->data)) {
                    break;
                }
                $current_page_data[] = $this->data[$y];
            }

            $current_page_name = $this->page_name . (string)$i;
            $page_data[$current_page_name] = $current_page_data;
        }

        $buttons .= "</ul>";

        $processed_data = ['page_data' => $page_data, 'buttons' => $buttons];
        $this->processed_data = $processed_data;
        $this->current_buttons_template = $buttons;
    }

    public function gen_template()
    {
        $temp = '';

        $current_page = $this->current_page;
        $current_page_name = $this->page_name . $current_page;

        if (isset($this->processed_data['page_data'][$current_page_name])) {
            $current_page_data = $this->processed_data['page_data'][$current_page_name];

            foreach ($current_page_data as $row) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author_id = $row['post_author'];
                $post_author = $this->all_users[$post_author_id];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_content = substr($post_content, 0, 200);
                $post_status = $row['post_status'];

                if ($post_status === 'published') {
                    $temp .= "
<!-- First Blog Post -->
<h1 class='d-inline'>
    <a href='post.php?post_id={$post_id}; '>{$post_title }</a>
</h1>
<p class='lead'>
    by
    <a href='author_post.php?author= {$post_author_id}&post_id={$post_id }'>{$post_author}</a>
</p>
<p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date }</p>
<hr>
<a href='post.php?post_id={$post_id}'>
    <img class='img-responsive' src='images/{$post_image}' alt=''>
</a>
<hr>
<p>{$post_content}</p>
<a class='btn btn-primary' href='post.php?post_id={$post_id}'>Read More <span
        class='glyphicon glyphicon-chevron-right'></span></a>
<hr>";
                }
            }
        }

        $this->current_page_template = $temp;
    }

    private function gen_buttons()
    {
        $buttons = "<ul class='pager'>";
        $main_url = $this->main_url;

        for ($i = 0; $i < $this->page_num; $i++) {
            $cu_page_num = $i + 1;

            if ($this->current_page == $i) {
                $buttons .= "<li><a class='btn current_page' href='{$main_url}?{$this->page_name}={$i}' ><b>{$cu_page_num}</b></a></li>";
            } else {
                $buttons .= "<li><a class='btn' href='{$main_url}?{$this->page_name}={$i}' >{$cu_page_num}</a></li>";
            }
        }
        $buttons .= "</ul>";
        $this->current_buttons_template = $buttons;
    }
}


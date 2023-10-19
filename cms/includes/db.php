<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
function confirmQuery($query)
{
    global $connection;
    if (!$query) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function excuseMysqliQuery($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($query);
}

function excuseMysqliQueryAndGetData($query, $err = true)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    if (!$query && $err) {
        die('QUERY FAILED' . mysqli_error($connection));
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

function excuseMysqliQueryAndGetCounts($column, $queryExtra = '')
{
    global $connection;
    $query = "SELECT * FROM {$column} ";
    if (strlen($queryExtra) > 0) {
        $query .= $queryExtra;
    }
    $result = mysqli_query($connection, $query);
    if (!$query) {
        die('QUERY FAILED' . mysqli_error($connection));
    } else {
        return mysqli_num_rows($result);
    }
}

function excuseMysqliQueryAndUpdateByID($table, $column, $newValue, $id_column, $id)
{
    global $connection;
    $query = "UPDATE {$table} SET {$column} = '{$newValue}' WHERE {$id_column} = {$id} ";
    echo $query;
    mysqli_query($connection, $query);
    if (!$query) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function excuseMysqliQueryAndDeleteByID($table, $id_column, $id)
{
    global $connection;
    $query = "DELETE FROM {$table} WHERE {$id_column} = {$id} ;";
    mysqli_query($connection, $query);
    if (!$query) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function getNewInsertId()
{
    global $connection;
    return mysqli_insert_id($connection);
}

# need work
class Column
{

}

class Table extends Column
{
    function __construct()
    {
        echo $this->moveWheels();
    }
}



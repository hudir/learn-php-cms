<?php

function checkAdmin()
{
    if ($_SESSION['user_role'] === 'admin') {
        return true;
    } else {
        return false;
    }
}

function blockNoneAdminUser()
{
    header("Location: index.php");
    echo 'You are not able to do it';
}
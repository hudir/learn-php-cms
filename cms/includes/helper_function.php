<?php

function fixImageURL($relativUrl) {
    return '/demo/cms/'. $relativUrl;
}



function addHighLight($str): string
{
    return "<span class='btn-warning'>" . $str . "</span>";
}



function getAuthorMap(): array
{
    $allAuthor = excuseMysqliQueryAndGetData("SELECT user_id, user_name FROM users;");
    if ($allAuthor) {
        $result = [];
        foreach ($allAuthor as $row) {
            $id = (integer)$row['user_id'];
            $name = $row['user_name'];
            $result[$id] = $name;
        }
        return $result;
    } else {
        return [];
    }
}
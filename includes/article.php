<?php

ini_set('display_errors', 1); 

function getArticleFromDB ($connection, $id, $columnName = "*") {
    $sql = "SELECT $columnName FROM article WHERE id = :id";

    $stmt = $connection -> prepare($sql);
    $stmt -> bindValue(":id", $id, PDO::PARAM_INT);

    if ($stmt -> execute()) {
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    } 
}


?>
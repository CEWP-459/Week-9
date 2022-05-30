<?php

class Database
{
    public function getConn()
    {
        $db_host = "localhost";
        $db_name = "blog";
        $db_username = "blog_www";
        $db_password = "LZR]PHvInWKW!]6*";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

        try {
            return new PDO($dsn, $db_username, $db_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

    }
}

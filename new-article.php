<?php

ini_set('display_errors', 1); 
require 'classes/Database.php'; 
require 'classes/Article.php'; 
require 'includes/auth.php'; 

session_start();

if (!isLoggedIn()) {
    die("Unauthorised!");
}

$article = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    $db = new Database();
    $connection = $db -> getConn();

    $article -> title = $_POST['title'];
    $article -> content = $_POST['content'];
    $article -> published_at = $_POST['published_at'];

    if ($article -> create($connection)) {
        header("Location: ./single-article.php?id={$article->id}");
    }

}

?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/article-form.php'; ?>
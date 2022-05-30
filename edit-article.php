<?php

    ini_set('display_errors', 1); 

    require 'classes/Database.php'; 
    require 'classes/Article.php'; 
    
    $db = new Database();
    $connection = $db -> getConn();

   
    if (isset($_GET['id'])) {

        $article = Article::getById($connection, $_GET['id']);

        if (!$article) {
            die('No Such Article Found!');
        }

    } else {

        die('Article ID is Not Supplied!');
    
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $article -> title = $_POST['title'];
        $article -> content = $_POST['content'];
        $article -> published_at = $_POST['published_at'];

        if ($article -> update($connection)) {
            header("Location: ./single-article.php?id={$article->id}");
        }
    }
    
?>

<?php require 'includes/header.php'; ?>

<h2>Edit article</h2>

<?php require 'includes/article-form.php'; ?>
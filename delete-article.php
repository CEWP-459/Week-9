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
  
    if ($article -> delete($connection)) {

        header("Location: /");
    
    }

}

?>


<?php require 'includes/header.php'; ?>

<h2> Delete article </h2>
<h3> Are you sure? </h3>
<form method="post">
    <button>Delete Article</button>
</form> 
<a href="./single-article.php?id=<?= $article -> id ?>">Cancel</a>  
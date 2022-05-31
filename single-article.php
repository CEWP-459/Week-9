<?php

    ini_set('display_errors', 1); 

    require './includes/init.php';
    
    $db = new Database();
    $connection = $db -> getConn();

    if (isset($_GET['id'])) {
        $article = Article::getById($connection, $_GET['id']);
    } else {
        $article = null;
    }
    
?>

<?php require 'includes/header.php'; ?>
<body>
    <h1>Blog</h1>
    <?php if (!$article) : ?>
        <h2> No articles found! </h2>
    <?php else: ?>    
        <ol>
            <li>
                <h3>Title:</h3>
                <?= htmlspecialchars($article -> title); ?>
                <h3>Content:</h3>
                <?= htmlspecialchars($article -> content); ?>
            </li>
        </ol>
        <a href="./edit-article.php?id=<?= $article -> id ?>">Edit Article</a>
        <a href="./delete-article.php?id=<?= $article -> id ?>">Delete Article</a>  
    <?php endif; ?>    
</body>

</html>
<?php

require './includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connection = require './includes/db.php';

    if (User::authenticate($connection, $_POST['username'], $_POST['password'])) {

        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        header("Location: /");

    } else {

        $error = "login incorrect";

    }
}

?>
<?php require 'includes/header.php'; ?>

<h2>Login</h2>

<?php if (! empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">

    <div>
        <label for="username">Username</label>
        <input name="username" id="username">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <button>Log in</button>

</form>


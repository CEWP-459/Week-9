<?php

require './classes/User.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (User::authenticate()) {

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

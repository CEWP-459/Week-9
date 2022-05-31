<?php

$password = "secret";

$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;


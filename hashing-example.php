<?php

$password = "secret";

// $hash = password_hash($password, PASSWORD_DEFAULT);

// echo $hash;

$hash = '$2y$10$l4PaVroYaOgl0WbNV0T5MO8BU7F3eQpagX5glIXXkRpQxv/ji4UKS';

var_dump(password_verify($password, $hash));